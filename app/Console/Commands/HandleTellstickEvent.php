<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class HandleTellstickEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tellstick:event {--deviceid=} {--method=} {--methoddata=} {--changeevent=} {--changetype=} {--rawdata=} {--protocol=} {--model=} {--sensorid=} {--controllerid=} {--datatype=} {--value=} {--timestamp=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle an event from a Telldus TellStick Duo device';

    /**
     * Create a new command instance.
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
        if ( $this->option('datatype') == 1 )
        {
            Log::info("Tellstick: Sensor: " . $this->option('sensorid') . ": Temperature: " . $this->option('value'));
        }
        if ( $this->option('datatype') == 2 )
        {
            Log::info("Tellstick: Sensor: " . $this->option('sensorid') . ": Humidity: " . $this->option('value'));
        }
    }
}
