<?php

return [
    /*
    |--------------------------------------------------------------------------
    | End Point Api ( Server Configuration )
    |--------------------------------------------------------------------------
    |
    | Starter : http://rajaongkir.com/api/starter
    | Basic : http://rajaongkir.com/api/basic
    | Pro : http://pro.rajaongkir.com/api
    |
    */
    'account_type' => env('RAJAONGKIR_ACCOUNT_TYPE', 'starter'),
    /*
    |--------------------------------------------------------------------------
    | API key
    |--------------------------------------------------------------------------
    | You can get API key in www.rajaongkir.com
    |
    */

    'api_key' => env('RAJAONGKIR_API_KEY', 'your-api-key'),
    /*
    |--------------------------------------------------------------------------
    | For Caching
    |--------------------------------------------------------------------------
    | You are free to change the cache configuration.
    */

    'province_table' => env('RAJAONGKIR_PROV_TABLE', 'ro_province'),

    'city_table' => env('RAJAONGKIR_CITY_TABLE', 'ro_city'),

    // Cache supported database,and file, default value : database
    'cache_type' => env('RAJAONGKIR_CACHE', 'file'),

];
