<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Irfa\RajaOngkir\Ongkir\Ongkir as RajaOngkir;

class ROCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raja-ongkir:city-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create city list cache for faster loading city list';

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
        RajaOngkir::cachingCity();
    }
}
