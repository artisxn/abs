<?php

namespace App\Http\Controllers\Api\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\WorldItem;

use App\Http\Resources\Api\WorldItem as WorldItemResource;

class WorldShowController extends Controller
{
    /**
     * @param Request $request
     * @param         $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function asin(Request $request, $asin)
    {
        $item = $this->get('asin', $asin);

        return WorldItemResource::collection($item);
    }

    /**
     * @param Request $request
     * @param         $ean
     *
     * @return \Illuminate\Http\Response
     */
    public function ean(Request $request, $ean)
    {
        $item = $this->get('ean', $ean);

        return WorldItemResource::collection($item);
    }

    /**
     * @param string $column
     * @param string $asin
     *
     * @return mixed
     */
    private function get($column, $asin)
    {
        $item = WorldItem::where($column, $asin)
                         ->latest('updated_at')
                         ->with(['availability', 'binding', 'browses'])
                         ->when(request()->filled('country'), function ($query) {
                             return $query->whereIn('country', explode(',', request()->input('country')));
                         })->get();

        abort_if($item->isEmpty(), 404, 'Not Found');

        return $item;
    }
}
