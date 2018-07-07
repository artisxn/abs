<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('horizon:snapshot')
                 ->everyFiveMinutes()
                 ->onOneServer();


        //負荷分散のため時間は多少ずらす

        $schedule->command('abs:random-browse')
                 ->hourlyAt(21)
                 ->when(config('feature.random_browse'))
                 ->onOneServer();

        $schedule->command('abs:recent-item')
                 ->hourlyAt(45)
                 ->when(config('feature.recent_item'))
                 ->onOneServer();

        $schedule->command('abs:watch-item')
                 ->dailyAt('00:15')
                 ->when(config('feature.watch_item'))
                 ->onOneServer();

        $schedule->command('abs:count-info')
                 ->dailyAt('12:10')
                 ->onOneServer();

        $schedule->command(Commands\Mainte\UpdateOldItem::class)
                 ->hourlyAt(25)
                 ->when(config('feature.update_old_item'))
                 ->onOneServer();

        $schedule->command(Commands\Mainte\DeleteOldItem::class)
                 ->dailyAt('04:10')
            //                 ->weeklyOn(1, '04:10')
                 ->when(config('feature.delete_old_item'))
                 ->onOneServer();

        $schedule->command(Commands\Mainte\DeleteOldPost::class)
                 ->dailyAt('06:06')
                 ->when(config('feature.delete_old_post'))
                 ->onOneServer();

        $schedule->command('abs:delete-category')
                 ->hourlyAt(44)
                 ->when(config('feature.delete_category'))
                 ->onOneServer();

        $schedule->command('abs:world-watch')
                 ->everyFiveMinutes()
                 ->when(config('feature.world_watch_item'))
                 ->onOneServer();

        //優先度の高いものは多く更新
        $schedule->command('abs:world-watch --priority=1')
                 ->everyTenMinutes()
                 ->when(config('feature.world_watch_item'))
                 ->onOneServer();

        $schedule->command(Commands\PriceAlertCommand::class)
                 ->hourly()
                 ->when(config('feature.price_alert'))
                 ->onOneServer();

        $schedule->command(Commands\WatchPriceAlertCommand::class)
                 ->hourlyAt(30)
                 ->when(config('feature.price_alert'))
                 ->onOneServer();

        $schedule->command('abs:watch-item')
                 ->hourlyAt(45)
                 ->when(config('feature.price_alert_express'))
                 ->onOneServer();

        $schedule->command(Commands\WatchPriceAlertCommand::class)
                 ->everyThirtyMinutes()
                 ->when(config('feature.price_alert_express'))
                 ->onOneServer();

        $schedule->command(Commands\World\ChatWorkCommand::class)
                 ->dailyAt('09:00')
                 ->when(config('feature.chatwork'))
                 ->onOneServer();

        $schedule->command(Commands\Mainte\DeleteOldHistory::class)
                 ->dailyAt('04:40')
                 ->onOneServer();

        $schedule->command(Commands\Feature\FeatureUpdate::class)
                 ->dailyAt('10:16')
                 ->when(config('feature.feature_page'))
                 ->onOneServer();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
