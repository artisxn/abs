<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Repository\Item\ItemRepositoryInterface as Item;

class DeleteCategoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:delete-category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '除外カテゴリーのアイテム削除';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Item $repository
     *
     * @return mixed
     */
    public function handle(Item $repository)
    {
        $cats = config('amazon.delete_category');

        foreach ($cats as $cat) {
            $repository->deleteCategory($cat, 1000);
        }
    }
}
