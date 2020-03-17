<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Irfa\RajaOngkir\Caching\ROCache;
use Irfa\RajaOngkir\Ongkir\Ongkir as RajaOngkir;

class RORefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raja-ongkir:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Cache';

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
        echo '---------------------'.PHP_EOL;
        echo'Refresh Cache'.PHP_EOL;
        echo'---------------------'.PHP_EOL;
        ROCache::clearCache();
        sleep(1); //Cooling Down
        echo PHP_EOL.'---------------------'.PHP_EOL;
        echo'Province Caching'.PHP_EOL;
        echo'---------------------'.PHP_EOL;
        RajaOngkir::cachingProvince();
        echo PHP_EOL.'---------------------'.PHP_EOL;
        sleep(1); //Cooling Down
        echo'City Caching'.PHP_EOL;
        echo '---------------------'.PHP_EOL;
        RajaOngkir::cachingCity();
        echo PHP_EOL.'---------------------'.PHP_EOL;
    }
}
