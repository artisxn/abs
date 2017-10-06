<?php

namespace App\Repository\Item;

use App\Model\Item;

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
    public function show(string $asin)
    {
        $asin_item = $this->item->findOrFail($asin);

        $asin_item->load([
            'histories' => function ($query) {
                $query->latest()->limit(30);
            },
        ]);

        return $asin_item;
    }

    /**
     * @inheritDoc
     */
    public function recent()
    {
        return $this->item->latest('updated_at')
                          ->whereDoesntHave('browses', function ($query) {
                              $query->whereIn('browse_id', config('amazon.recent_except'));
                          })
                          ->take(24)
                          ->get();
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
        return $this->item->count('asin');
    }

    /**
     * @inheritDoc
     */
    public function create(array $item = null)
    {
        $asin = array_get($item, 'ASIN');

        if (empty($asin)) {
            return;
        }

        $rank = array_get($item, 'SalesRank');
        $title = array_get($item, 'ItemAttributes.Title');
        $attributes = array_get($item, 'ItemAttributes');
        $offer_summary = array_get($item, 'OfferSummary');
        $offers = array_get($item, 'Offers');
        $image_sets = array_get($item, 'ImageSets');
        $large_image = array_get($item, 'LargeImage.URL');
        $detail_url = array_get($item, 'DetailPageURL');

        info($title);

        $new_item = $this->updateOrCreate([
            'asin' => $asin,
        ], compact([
            'title',
            'rank',
            'attributes',
            'offer_summary',
            'offers',
            'image_sets',
            'large_image',
            'detail_url',
        ]));

        $browse_nodes = $this->browseNodes($item);

        $new_item->browses()->sync($browse_nodes);
    }

    /**
     * @param array $item
     *
     * @return array
     */
    private function browseNodes(array $item): array
    {
        $ids = [];
        $nodes = array_get($item, 'BrowseNodes');

        while ($nodes = array_get($nodes, 'BrowseNode')) {
            if (!array_has($nodes, 'BrowseNodeId')) {
                $nodes = head($nodes);
            }

            $ids[] = (int)array_get($nodes, 'BrowseNodeId');

            $nodes = array_get($nodes, 'Ancestors');
        }

        return $ids;
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
