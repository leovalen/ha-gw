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
        Commands\HandleTellstickEvent::class,
        Commands\TellstickSubscribe::class,
        Commands\TellstickScanDevices::class,
        Commands\TurnOnDevice::class,
        Commands\TurnOffDevice::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('tellstick:scan')->everyMinute();

        // Turn on and off espresson machine in the morning
        $schedule->command('device:on 5')
            ->weekdays()
            ->dailyAt('23:21');

        $schedule->command('device:on 5')
            ->weekdays()
            ->dailyAt('07:30');

        $schedule->command('device:off 5')
            ->weekdays()
            ->dailyAt('08:30');


    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
