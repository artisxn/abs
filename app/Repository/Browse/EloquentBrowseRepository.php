<?php

namespace App\Repository\Browse;

use App\Model\Browse;
use App\Model\BrowseItem;
use App\Model\Item;

class EloquentBrowseRepository implements BrowseRepositoryInterface
{
    /**
     * @var Browse
     */
    protected $browse;

    /**
     *
     * @param Browse $browse
     */
    public function __construct(Browse $browse)
    {
        $this->browse = $browse;
    }

    /**
     * @inheritDoc
     */
    public function listAll($paginate = 100)
    {
        $cache_key = 'browse.list.all.' . request()->input('page', 1);

        $lists = cache()->remember($cache_key, 60, function () use ($paginate) {
            return $this->browse->withCount('browseItems')
                                ->orderBy('browse_items_count', 'desc')
                                ->paginate($paginate);
        });

        return $lists;
    }

    /**
     * @inheritDoc
     */
    public function createNodes(array $browse_nodes)
    {
        if (empty($browse_nodes)) {
            return;
        }

        foreach ($browse_nodes as $title => $browse_id) {
            $this->updateOrCreate([
                'id' => $browse_id,
            ], [
                'title' => $title,
            ]);
        }
    }

    /**
     * @inheritDoc
     */
    public function export(
        string $category,
        string $order = 'updated_at',
        string $sort = 'desc',
        int $limit = 1000
    ) {
        $browse_item = BrowseItem::where('browse_id', $category);
        $asins = $browse_item->pluck('item_asin');

        $items = Item::whereIn('asin', $asins)
                     ->orderBy($order, $sort)
                     ->take($limit)
                     ->get();

        return $items;

        //        return $this->browse->findOrFail($category)
        //                            ->items()
        //                            ->orderBy($order, $sort)
        //                            ->take($limit)
        //                            ->get();
    }

    /**
     * @inheritDoc
     */
    public function exportCursor(
        string $category,
        string $order = 'updated_at',
        string $sort = 'desc',
        int $limit = 1000
    ) {
        return $this->browse->findOrFail($category)
                            ->items()
                            ->orderBy($order, $sort)
                            ->take($limit)
                            ->cursor();
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return $this->browse->count('id');
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(int $id)
    {
        return $this->browse->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->browse->updateOrCreate($attributes, $values);
    }
}
