<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\BrowseJob;

class RandomBrowse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:random-browse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ランダムブラウズを更新';

    /**
     * Create a new command instance.
     *
     * @param  BrowseService $service
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
     * @return mixed
     */
    public function handle()
    {
        $browse = collect(config('amazon-browse'))->random();

        $browse_items = dispatch_now(new BrowseJob($browse, 'NewReleases'));

        cache()->forever('random_items', $browse_items);
    }
}
