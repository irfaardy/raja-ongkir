<?php

namespace Irfa\RajaOngkir\Console\Commands;

use Illuminate\Console\Command;
use Irfa\RajaOngkir\Ongkir\Ongkir as RajaOngkir;

class ROCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raja-ongkir:cache {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create cache RajaOngkir';

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
        if($this->argument('name') == "all"){
            $this->all();
        } elseif($this->argument('name') == "city"){
            RajaOngkir::cachingCity();
        } elseif($this->argument('name') == "province"){
             RajaOngkir::cachingProvince();
        } elseif($this->argument('name') == "subdistrict"){
             RajaOngkir::cachingSubDistrict();
        } elseif($this->argument('name') == "clear"){
             ROCache::clearCache();
        } elseif($this->argument('name') == "refresh"){
             ROCache::refresh();
        } else{
             $this->line('<fg=yellow>Valid input is  all, clear, refresh, city, province and subdistrict.');
        }
    }
    private function all(){
        echo "---------------------".PHP_EOL;
        echo"Province Caching".PHP_EOL;
        echo"---------------------".PHP_EOL;
        RajaOngkir::cachingProvince();
        echo PHP_EOL."---------------------".PHP_EOL;
        sleep(1);//Cooling Down
        echo"City Caching".PHP_EOL;
        echo "---------------------".PHP_EOL;
        RajaOngkir::cachingCity();
        echo PHP_EOL."---------------------".PHP_EOL;
        sleep(1);//Cooling Down
        echo"Subdistrict Caching".PHP_EOL;
        echo "---------------------".PHP_EOL;
        RajaOngkir::cachingSubDistrict();
        echo PHP_EOL."---------------------".PHP_EOL;
    }
    private function refresh(){
        echo "---------------------".PHP_EOL;
        echo"Refresh Cache".PHP_EOL;
        echo"---------------------".PHP_EOL;
        ROCache::clearCache();
        echo "---------------------".PHP_EOL;
        echo"Province Caching".PHP_EOL;
        echo"---------------------".PHP_EOL;
        RajaOngkir::cachingProvince();
        echo PHP_EOL."---------------------".PHP_EOL;
        sleep(1);//Cooling Down
        echo"City Caching".PHP_EOL;
        echo "---------------------".PHP_EOL;
        RajaOngkir::cachingCity();
        echo PHP_EOL."---------------------".PHP_EOL;
        sleep(1);//Cooling Down
        echo"Subdistrict Caching".PHP_EOL;
        echo "---------------------".PHP_EOL;
        RajaOngkir::cachingSubDistrict();
        echo PHP_EOL."---------------------".PHP_EOL;
    }
}
