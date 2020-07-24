<?php

namespace Irfa\RajaOngkir\Console\Commands;

use Illuminate\Console\Command;
use Irfa\RajaOngkir\Ongkir\Ongkir as RajaOngkir;

class ROInfoPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raja-ongkir {cmd}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Option';

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
        if($this->argument('cmd') == "version" || $this->argument('cmd') == "v" ){
            $this->informasi();
        } elseif($this->argument('cmd') == "key"){
            $this->line('Api Key: '.config('irfa.rajaongkir.api_key'));
        } elseif($this->argument('cmd') == "type"){
            $this->line('Account Type: '.config('irfa.rajaongkir.account_type'));
        }  elseif($this->argument('cmd') == "info"){
             $this->informasi();
            $this->line('-------------------------------------------------------------------------------');
            $this->line('Account Type: '.config('irfa.rajaongkir.account_type'));
            $this->line('Api Key: '.config('irfa.rajaongkir.api_key'));
            $this->line('Api Version: '.config('irfa.rajaongkir.api_version'));
            $this->line('Province Table: '.config('irfa.rajaongkir.province_table'));
            $this->line('City Table: '.config('irfa.rajaongkir.city_table'));
            $this->line('Subdistrict Table: '.config('irfa.rajaongkir.subdistrict_table'));
            $this->line('Cache Type: '.config('irfa.rajaongkir.cache_type'));
        } else{
             $this->line('<fg=yellow>valid input is  version, key, type, info,and v.');
        }
    }

    private function informasi(){
         $this->line(" |_   _|     / _|               |  __ \     (_)        / __ \            | |  (_)     
   | |  _ __| |_ __ _   ______  | |__) |__ _ _  __ _  | |  | |_ __   __ _| | ___ _ __ 
   | | | '__|  _/ _` | |______| |  _  // _` | |/ _` | | |  | | '_ \ / _` | |/ / | '__|
  _| |_| |  | || (_| |          | | \ \ (_| | | (_| | | |__| | | | | (_| |   <| | |   
 |_____|_|  |_| \__,_|          |_|  \_\__,_| |\__,_|  \____/|_| |_|\__, |_|\_\_|_|   
                                           _/ |                      __/ |            
                                          |__/                      |___/             ".PHP_EOL);

    $this->line('-------------------------------------------------------------------------------');
    $this->line('Raja Ongkir');
    $this->line('Version 1.6.0 (2020)');
    $this->line('https://github.com/irfaardy/raja-ongkir');
    }
   
}
