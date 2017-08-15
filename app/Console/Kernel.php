<?php

namespace app\Console;

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
        Commands\MessageSent::class,
        Commands\MessageFailed::class,
        Commands\MessageReceived::class,
        Commands\UpdateWeather::class,
        Commands\UpdateEarthquake::class,
        Commands\UpdateCyclone::class,
        Commands\UpdateVolcano::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('earthquake')->everyFiveMinutes();
        $schedule->command('weather')->everyFiveMinutes();
        $schedule->command('cyclone')->everyFiveMinutes();
        $schedule->command('volcano')->everyFiveMinutes();
    }
}
