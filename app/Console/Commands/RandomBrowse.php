<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Service\BrowseService;

class RandomBrowse extends Command
{
    /**
     * @var BrowseService
     */
    protected $service;

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
    public function __construct(BrowseService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        info('Random Browse');

        $browse = collect(config('amazon-browse'))->random();

        $browse_items = $this->service->browse($browse);

        cache()->forever('random_items', $browse_items);
    }
}
