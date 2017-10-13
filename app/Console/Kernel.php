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
        //負荷分散のため時間は多少ずらす

        $schedule->command('abs:random-browse')
                 ->hourlyAt(21)
                 ->when(config('amazon-feature.random_browse'));

        $schedule->command('abs:recent-item')
                 ->hourlyAt(33)
                 ->when(config('amazon-feature.recent_item'));

        $schedule->command('abs:watch-item')
                 ->dailyAt('00:15')
                 ->when(config('amazon-feature.watch_item'));

        $schedule->command('abs:count-info')
                 ->hourlyAt(52);

        $schedule->command('abs:old-item')
                 ->hourlyAt(11)
                 ->when(config('amazon-feature.old_item'));

        $schedule->command('abs:delete-category')
                 ->hourlyAt(44)
                 ->when(config('amazon-feature.delete_category'));

        $schedule->command('abs:world-watch')
                 ->dailyAt('07:10')
                 ->when(config('amazon-feature.world_watch_item'));

        //優先度の高いものは多く更新
        $schedule->command('abs:world-watch --priority=1')
                 ->twiceDaily(1, 13)
                 ->when(config('amazon-feature.world_watch_item'));

        $schedule->command(Commands\Mainte\UpdateAvailabilityCommand::class)
                 ->everyTenMinutes();
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
