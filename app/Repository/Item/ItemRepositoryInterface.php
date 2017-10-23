<?php

namespace App\Repository\Item;

use App\Model\Item;

interface ItemRepositoryInterface
{
    /**
     * 価格チェック用
     *
     * @return mixed
     */
    public function priceAlert();

    /**
     * @param string $asin
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function show(string $asin);

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function recent();

    /**
     * @param int $limit
     *
     * @return \Generator
     */
    public function oldCursor(int $limit = 100);

    /**
     * @param int $days
     *
     * @return mixed
     */
    public function deleteOld(int $days = 30);

    /**
     * グラフ用の履歴データ
     *
     * @param string $asin
     * @param int    $limit
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function histories(string $asin, int $limit);

    /**
     * @return int
     */
    public function count();

    /**
     * @param array|null $item
     *
     * @return mixed
     */
    public function create(array $item = null);

    /**
     * 指定カテゴリーのアイテムを削除
     *
     * @param int $browse_id
     * @param int $limit
     *
     * @return void
     */
    public function deleteCategory(int $browse_id, int $limit = 1000);

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
     * @return \Illuminate\Database\Eloquent\Model|Item
     */
    public function updateOrCreate(array $attributes, array $values = []);
}
