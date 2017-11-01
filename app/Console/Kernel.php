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
                 ->everyFiveMinutes();


        //負荷分散のため時間は多少ずらす

        $schedule->command('abs:random-browse')
                 ->hourlyAt(21)
                 ->when(config('feature.random_browse'));

        $schedule->command('abs:recent-item')
                 ->hourlyAt(33)
                 ->when(config('feature.recent_item'));

        $schedule->command('abs:watch-item')
                 ->dailyAt('00:15')
                 ->when(config('feature.watch_item'));

        $schedule->command('abs:count-info')
                 ->hourlyAt(52);

        $schedule->command(Commands\Mainte\UpdateOldItem::class)
                 ->hourlyAt(25)
                 ->when(config('feature.update_old_item'));

        $schedule->command(Commands\Mainte\DeleteOldItem::class)
                 ->daily()
                 ->when(config('feature.delete_old_item'));

        $schedule->command(Commands\Mainte\DeleteOldPost::class)
                 ->dailyAt('06:06')
                 ->when(config('feature.delete_old_post'));

        $schedule->command('abs:delete-category')
                 ->hourlyAt(44)
                 ->when(config('feature.delete_category'));

        $schedule->command('abs:world-watch')
                 ->hourlyAt(2)
                 ->when(config('feature.world_watch_item'));

        //優先度の高いものは多く更新
        $schedule->command('abs:world-watch --priority=1')
                 ->hourlyAt(32)
                 ->when(config('feature.world_watch_item'));

        $schedule->command(Commands\PriceAlertCommand::class)
                 ->hourly()
                 ->when(config('feature.price_alert'));

        $schedule->command(Commands\WatchPriceAlertCommand::class)
                 ->hourly()
                 ->when(config('feature.price_alert'));


        $schedule->command('abs:watch-item')
                 ->hourlyAt(45)
                 ->when(config('feature.price_alert_express'));

        $schedule->command(Commands\WatchPriceAlertCommand::class)
                 ->everyThirtyMinutes()
                 ->when(config('feature.price_alert_express'));
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
