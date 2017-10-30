<?php

namespace App\Repository\WorldItem;

use App\Model\WorldItem;
use App\Model\Binding;
use App\Model\Availability;

class EloquentWorldItemRepository implements WorldItemRepositoryInterface
{
    /**
     * @var WorldItem
     */
    protected $model;

    /**
     *
     * @param WorldItem $item
     */
    public function __construct(WorldItem $item)
    {
        $this->model = $item;
    }

    /**
     * @inheritDoc
     */
    public function index()
    {
        $world_items = request()->user()
                                ->worldItems()
                                ->with(['availability', 'binding', 'browses'])
                                ->latest('updated_at')
                                ->when(request()->filled('search'), function ($query) {
                                    $search = request()->input('search');

                                    return $query->where('title', 'LIKE', '%' . $search . '%')
                                                 ->orWhere('asin', $search)
                                                 ->orWhere('ean', $search);
                                })
                                ->paginate(100);

        return $world_items;
    }

    /**
     * @inheritDoc
     */
    public function newIndex()
    {
        $world_items = request()->user()
                                ->worldItems()
                                ->with(['availability', 'binding', 'browses'])
                                ->latest()
                                ->paginate(100);

        return $world_items;
    }

    /**
     * @inheritDoc
     */
    public function show(string $asin)
    {
        $world_items = $this->model->whereAsin($asin)
                                   ->with(['availability', 'binding', 'browses'])
                                   ->get();

        return $world_items;
    }

    /**
     * @inheritDoc
     */
    public function apiIndex()
    {
        $items = request()->user()
                          ->worldItems()
                          ->latest('updated_at')
                          ->with(['availability', 'binding', 'browses'])
                          ->when(request()->filled('search'), function ($query) {
                              $search = request()->input('search');

                              return $query->where('title', 'LIKE', '%' . $search . '%')
                                           ->orWhere('asin', $search)
                                           ->orWhere('ean', $search);
                          })
                          ->when(request()->filled('country'), function ($query) {
                              return $query->whereIn('country', explode(',', request()->input('country')));
                          })
                          ->paginate(request()->input('limit', 50));

        return $items;
    }

    /**
     * @inheritDoc
     */
    public function apiNew()
    {
        $items = $this->model->latest()
                             ->with(['availability', 'binding', 'browses'])
                             ->when(request()->filled('since'), function ($query) {
                                 return $query->whereDate('created_at', '>=', request()->input('since'));
                             })
                             ->when(request()->filled('country'), function ($query) {
                                 return $query->whereIn('country', explode(',', request()->input('country')));
                             })
                             ->paginate(request()->input('limit', 10));

        return $items;
    }

    /**
     * @inheritDoc
     */
    public function apiShow(string $column, string $asin)
    {
        $item = $this->model->where($column, $asin)
                            ->latest('updated_at')
                            ->with(['availability', 'binding', 'browses'])
                            ->when(request()->filled('country'), function ($query) {
                                return $query->whereIn('country', explode(',', request()->input('country')));
                            })->get();

        return $item;
    }

    /**
     * @inheritDoc
     */
    public function apiUpdateAsins(array $asins, string $country)
    {
        $item = $this->model->whereIn('asin', $asins)
                            ->latest('updated_at')
                            ->with(['availability', 'binding', 'browses'])
                            ->whereCountry($country)
                            ->get();

        return $item;
    }

    /**
     * @inheritDoc
     */
    public function create(array $item = null, string $country)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return null;
        }

        $ean = array_get($item, 'ItemAttributes.EAN');

        $rank = array_get($item, 'SalesRank');
        $title = array_get($item, 'ItemAttributes.Title');

        $lowest_new_price = array_get($item, 'OfferSummary.LowestNewPrice.Amount');
        $lowest_new_formatted_price = array_get($item, 'OfferSummary.LowestNewPrice.FormattedPrice');

        $lowest_used_price = array_get($item, 'OfferSummary.LowestUsedPrice.Amount');
        $lowest_used_formatted_price = array_get($item, 'OfferSummary.LowestUsedPrice.FormattedPrice');

        $total_new = array_get($item, 'OfferSummary.TotalNew');
        $total_used = array_get($item, 'OfferSummary.TotalUsed');
        $editorial_review = array_get($item, 'EditorialReviews.EditorialReview.Content');


        /**
         * @var WorldItem $world_item
         */
        $world_item = $this->model->updateOrCreate([
            'asin'    => $asin,
            'country' => $country,
        ], compact([
            'ean',
            'title',
            'rank',
            'lowest_new_price',
            'lowest_new_formatted_price',
            'lowest_used_price',
            'lowest_used_formatted_price',
            'total_new',
            'total_used',
            'editorial_review',
        ]));

        //Availability
        $availability = array_get($item, 'Offers.Offer.OfferListing.Availability', '');
        $ava = Availability::firstOrCreate(compact('availability'));
        $world_item->availability()->associate($ava);

        //Binding
        $binding = array_get($item, 'ItemAttributes.Binding');

        if (!empty($binding)) {
            $bind = Binding::firstOrCreate(compact('binding'));
            $world_item->binding()->associate($bind);
        }

        $world_item->save();

        return $world_item;
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(string $asin)
    {
        return $this->model->findOrFail($asin);
    }

    /**
     * @inheritDoc
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }
}
