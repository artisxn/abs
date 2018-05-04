<?php

namespace App\Repository\WorldItem;

use App\Model\WorldItem;

class EloquentWorldItemRepository implements WorldItemRepositoryInterface
{
    use Traits\Create;
    use Traits\Api;

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
