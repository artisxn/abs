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

        if (config('amazon-feature.random-browse')) {
            $schedule->command('abs:random-browse')
                     ->hourlyAt(21);
        }

        $schedule->command('abs:recent-item')
                 ->hourlyAt(33);

        $schedule->command('abs:watch-item')
                 ->dailyAt('00:15');

        $schedule->command('abs:count-info')
                 ->hourlyAt(52);

        $schedule->command('abs:old-item')
                 ->hourlyAt(11);
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
