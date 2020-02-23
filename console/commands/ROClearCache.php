<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Irfa\RajaOngkir\Caching\ROCache;

class ROClearCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raja-ongkir:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clearing cache province and city.';

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
        ROCache::clearCache();
    }
}
