<?php

namespace App\Console\Commands;

use App\Reading;
use App\Sensor;
use Illuminate\Console\Command;
use Log;
use Redis;
use Carbon\Carbon;

class TellstickSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tellstick:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to redis events from Tellstick device';

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
        $types = [
            1 => 'temperature',
            2 => 'humidity',
            4 => 'rainrate',
            8 => 'raintotal',
            16 => 'winddirection',
            32 => 'windaverage',
            64 => 'windgust',
        ];

        Redis::subscribe(['tellstick'], function($json) use ($types) {
            $data = json_decode($json);

            // Identify the sensor
            $sensor = Sensor::where('self_id', $data->sensorid)
                ->where('protocol', $data->protocol)
                ->where('model', $data->model)
                ->get()
                ->first();

            if ( ! $sensor )
            {
                $sensor = Sensor::create([
                    'self_id' => $data->sensorid,
                    'model' => $data->model,
                    'protocol' => $data->protocol,
                ]);
            }

            // Check if the reading has already been registered
            $readings = Reading::where('timestamp', '>', Carbon::now()->subSeconds(5))
                ->where('sensor_id', $sensor->id)
                ->where('type', $types[$data->datatype])
                ->where('value', $data->value)->get()->count();

            if ($readings > 0) {
                Log::debug('Discarded reading as duplicate: '. $data->sensorid . ': ' . $data->value);
                return;
            }

            Reading::create([
                'sensor_id' => $sensor->id,
                'type' => $data->datatype,
                'value' => $data->value,
                'timestamp' => $data->timestamp,
            ]);


        });
    }
}