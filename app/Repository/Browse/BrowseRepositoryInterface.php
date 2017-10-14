<?php

namespace App\Repository\Browse;

interface BrowseRepositoryInterface
{
    /**
     * @param int $paginate
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     */
    public function listAll($paginate = 100);

    /**
     * @param array $browse_nodes
     *
     * @return void
     */
    public function createNodes(array $browse_nodes);

    /**
     * @param string $category
     * @param string $order
     * @param string $sort
     * @param int    $limit
     *
     * @return \Generator
     */
    public function exportCursor(
        string $category,
        string $order = 'updated_at',
        string $sort = 'desc',
        int $limit = 1000
    );

    /**
     * @return int
     */
    public function count();

    /**
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail(int $id);

    /**
     * @param array $attributes
     * @param array $values
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = []);
}
