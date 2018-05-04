<?php

namespace App\Repository\WorldItem\Traits;

trait Api
{
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
}
