<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Irfa\RajaOngkir\Ongkir\Ongkir as RajaOngkir;

class ROProvince extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raja-ongkir:prov-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create province list cache for faster loading province list';

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
        RajaOngkir::cachingProvince();
    }
}
