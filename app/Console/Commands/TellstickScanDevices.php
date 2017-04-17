<?php

namespace App\Console\Commands;

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
     *
     * @return void
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

    }
}