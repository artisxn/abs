<?php

namespace App\Http\Controllers\World;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repository\WorldItem\WorldItemRepositoryInterface as WorldItem;

class WorldController extends Controller
{
    /**
     * @var WorldItem
     */
    protected $repository;

    /**
     * WorldController constructor.
     *
     * @param WorldItem $repository
     */
    public function __construct(WorldItem $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $world_items = $this->repository->index();

        return view('world.index')->with(compact('world_items'));
    }

    /**
     * @param string $asin
     *
     * @return \Illuminate\Http\Response
     */
    public function show($asin)
    {
        $world_items = $this->repository->show($asin);

        return view('world.show')->with(compact('world_items'));
    }
}
