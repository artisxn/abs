<?php

namespace App\Repository\WorldItem;

interface WorldItemRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @return mixed
     */
    public function newIndex();

    /**
     * @param string $asin
     *
     * @return mixed
     */
    public function show(string $asin);

    /**
     * @return mixed
     */
    public function apiIndex();

    /**
     * @return mixed
     */
    public function apiNew();

    /**
     * @param string $column
     * @param string $asin
     *
     * @return mixed
     */
    public function apiShow(string $column, string $asin);

    /**
     * @param array  $asins
     * @param string $country
     *
     * @return mixed
     */
    public function apiUpdateAsins(array $asins, string $country);

    /**
     * @param array|null $item
     * @param string     $country
     *
     * @return \App\Model\WorldItem|\Illuminate\Database\Eloquent\Model|null
     */
    public function create(array $item = null, string $country);

    /**
     * @param string $asin
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail(string $asin);

    /**
     * @param array $attributes
     * @param array $values
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = []);
}
