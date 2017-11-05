<?php

namespace App\Console\Commands\World;

use Illuminate\Console\Command;

use App\Model\User;
use App\Jobs\World\WorldWatchJob;
use Illuminate\Support\Collection;

class WorldWatchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:world-watch {--P|priority=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '世界版ウォッチリストを更新';

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
     * @return mixed
     */
    public function handle()
    {
        //指定のユーザーIDのみ
        /**
         * @var User $user
         */
        $user = User::findOrFail(config('feature.world_watch_item_user_id'));

        $priority = $this->option('priority');
        info('Priority: ' . $priority);

        $watches = $user->watches()
                        ->where('priority', '>=', $priority)
                        ->oldest('updated_at')
                        ->limit(30)
                        ->get();

        $watches->each->touch();

        $asins = $watches->pluck('asin_id');

        info('World Watch: ' . $asins->count());

        $locales = config('feature.world_watch_item_locales');

        $delay = 1;

        /**
         * @var Collection $items
         */
        foreach ($asins->chunk(10) as $items) {
            foreach ($locales as $locale) {
                info($locale);

                $seconds = $delay * 10 + $priority * 5;

                WorldWatchJob::dispatch(
                    $items->toArray(),
                    $locale)->delay(now()->addSeconds($seconds)
                );

                $delay++;
            }
        }
    }
}
