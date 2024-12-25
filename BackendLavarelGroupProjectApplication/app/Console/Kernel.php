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
    protected $commands = [];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Schedule your Artisan commands here
        // Example: $schedule->command('inspire')->hourly();
    }

    /**
     * Register any commands for your application.
     *
     * @return void
     */
    public function commands()
    {
        // Load your Artisan commands here
        require base_path('routes/console.php');
    }
}
