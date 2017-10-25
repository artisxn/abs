<?php

namespace App\Repository\Item;

use App\Model\Item;
use App\Model\Browse;
use App\Model\Availability;
use App\Model\ItemAttribute;
use App\Model\OfferSummary;
use App\Model\Offer;
use App\Model\ImageSet;

class EloquentItemRepository implements ItemRepositoryInterface
{
    /**
     * @var Item
     */
    protected $item;

    /**
     *
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @inheritDoc
     */
    public function priceAlert()
    {
        $items = $this->item->latest('updated_at')
                            ->limit(1000)
                            ->whereNotNull('rank')
                            ->where('rank', '<', 1000)
                            ->has('histories', '>', 5)
                            ->whereHas('histories', function ($query) {
                                $query->whereNotNull('lowest_new_price');
                            })
                            ->doesntHave('watches')
                            ->get();

        return $items;
    }

    /**
     * @inheritDoc
     */
    public function show(string $asin)
    {
        $asin_item = $this->item->find($asin);

        if (!is_null($asin_item)) {
            $asin_item->load([
                'histories' => function ($query) {
                    $query->latest()->limit(30);
                },
            ]);
        }

        return $asin_item;
    }

    /**
     * @inheritDoc
     */
    public function recent()
    {
        $limit = 24;

        $recent = collect([]);

        $this->item->latest('updated_at')
                   ->whereNotNull('large_image')
                   ->with('browses')
                   ->chunk($limit, function ($items) use (&$recent, $limit) {
                       foreach ($items as $item) {
                           $browses = collect($item->browses)->whereIn('id', config('amazon.recent_except'));

                           if (blank($browses)) {
                               $recent->push($item);
                           }

                           if ($recent->count() >= $limit) {
                               break;
                           }
                       }

                       if ($recent->count() >= $limit) {
                           return false;
                       }
                   });

        return $recent;
    }

    /**
     * @inheritDoc
     */
    public function oldCursor(int $limit = 100)
    {
        return $this->item->oldest('updated_at')
                          ->select('asin')
                          ->limit($limit)
                          ->cursor();
    }

    /**
     * @inheritDoc
     */
    public function deleteOld(int $days = 30)
    {
        return $this->item->whereDate('updated_at', '<', now()->subDays($days))
                          ->has('histories', '<', 10);
    }

    /**
     * @inheritDoc
     */
    public function histories(string $asin, int $limit)
    {
        return $this->item->findOrFail($asin)
                          ->histories()
                          ->latest('day')
                          ->limit($limit)
                          ->get();
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return $this->item->count('updated_at');
    }

    /**
     * @inheritDoc
     */
    public function create(array $item = null)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return null;
        }

        $rank = array_get($item, 'SalesRank');
        $title = array_get($item, 'ItemAttributes.Title');
        $large_image = array_get($item, 'LargeImage.URL');
        $detail_url = array_get($item, 'DetailPageURL');

        //        info($title);

        $new_item = $this->updateOrCreate([
            'asin' => $asin,
        ], compact([
            'title',
            'rank',
            'large_image',
            'detail_url',
        ]));

        //Availability
        $availability = array_get($item, 'Offers.Offer.OfferListing.Availability', '');
        $ava = Availability::firstOrCreate(compact('availability'));
        $new_item->availability()->associate($ava)->save();

        //ItemAttribute
        $attributes = array_get($item, 'ItemAttributes');
        if (!empty($attributes)) {
            $attr = ItemAttribute::updateOrCreate([
                'item_asin' => $asin,
            ], [
                'attributes' => $attributes,
            ]);
        }

        //OfferSummary
        $offer_summary = array_get($item, 'OfferSummary');
        if (!empty($offer_summary)) {
            $summary = OfferSummary::updateOrCreate([
                'item_asin' => $asin,
            ], [
                'offer_summary' => $offer_summary,
            ]);
        }

        //Offers
        $offers = array_get($item, 'Offers');
        if (!empty($offers)) {
            $offer = Offer::updateOrCreate([
                'item_asin' => $asin,
            ], [
                'offers' => $offers,
            ]);
        }

        //ImageSet
        $image_sets = array_get($item, 'ImageSets');
        if (!empty($image_sets)) {
            $image = ImageSet::updateOrCreate([
                'item_asin' => $asin,
            ], [
                'image_sets' => $image_sets,
            ]);
        }

        return $new_item;
    }

    /**
     * @inheritDoc
     */
    public function deleteCategory(int $browse_id, int $limit = 1000)
    {
        info('Delete Category: Start ' . $browse_id);

        try {
            $items = Browse::findOrFail($browse_id)
                           ->items()
                //                           ->latest('updated_at')
                           ->limit($limit)
                           ->cursor();

            foreach ($items as $item) {
                /**
                 * itemsは残して詳細データのみ削除
                 */
                /**
                 * @var Item $item
                 */
                //                rescue(function () use ($item) {
                //                    $item->item_attribute()->delete();
                //                    $item->offers()->delete();
                //                    $item->offer_summary()->delete();
                //                    $item->image_sets()->delete();
                //                    $item->histories()->delete();
                //                    $item->touch();
                //                });

                /**
                 * itemごと全部削除。こっちのほうが早いのでどちらか選ぶ。
                 */
                $item->delete();

                cache()->forget('asin.' . $item->asin);
            }
        } catch (\Exception $e) {
            report($e);
        }

        info('Delete Category: End ' . $browse_id);
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(string $asin)
    {
        return $this->item->findOrFail($asin);
    }

    /**
     * @inheritDoc
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->item->updateOrCreate($attributes, $values);
    }
}
