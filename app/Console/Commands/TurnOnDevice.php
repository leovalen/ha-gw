<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TurnOnDevice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'device:on {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Turn on a device';

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
        exec("tdtool --on " . $this->argument('id'));
    }
}
