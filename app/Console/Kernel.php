<?php

namespace App\Console;

use App\Providers\EmergencyResponseProvider;
use App\Providers\InboundPatientsProvider;
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
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $alertScanner = new AlertScanner(new InboundPatientsProvider( new EmergencyResponseProvider(
            'http://ers.sergeylobin.ru/xml/inbound.xml', 80, 1000)));
        $schedule->call($alertScanner)->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
