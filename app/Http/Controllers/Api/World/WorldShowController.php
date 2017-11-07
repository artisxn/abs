<?php

namespace App\Http\Controllers\Api\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repository\WorldItem\WorldItemRepositoryInterface as WorldItem;

use App\Http\Resources\Api\WorldItem as WorldItemResource;

class WorldShowController extends Controller
{
    /**
     * @var WorldItem
     */
    protected $repository;

    /**
     * WorldShowController constructor.
     *
     * @param WorldItem $repository
     */
    public function __construct(WorldItem $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param         $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function asin($asin)
    {
        $item = $this->get('asin', $asin);

        return WorldItemResource::collection($item);
    }

    /**
     * @param         $ean
     *
     * @return \Illuminate\Http\Response
     */
    public function ean($ean)
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
        $item = $this->repository->apiShow($column, $asin);

        abort_if($item->isEmpty(), 404, 'Not Found');

        return $item;
    }
}
