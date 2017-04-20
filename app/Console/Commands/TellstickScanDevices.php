<?php

namespace App\Console\Commands;

use App\Device;
use Illuminate\Console\Command;

class TellstickScanDevices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tellstick:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan for devices and update models';

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
        $output = [];
        exec("tdtool --list-devices", $output);

        $devices = [];
        foreach ($output as $line)
        {
            $line = str_replace("\t", "&", $line);
            parse_str($line, $device);
            $devices[] = $device;
        }
        $devices = collect($devices);

        $devices->each(function($device) {
            Device::updateOrCreate(['id' => $device['id']], $device);
        });
    }
}
