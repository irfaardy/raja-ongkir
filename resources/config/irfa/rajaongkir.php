<?php

return [
    /*
    |--------------------------------------------------------------------------
    | End Point Api ( Server Configuration )
    |--------------------------------------------------------------------------
    |
    | Starter   : http://rajaongkir.com/api/starter
    | Basic     : http://rajaongkir.com/api/basic
    | Pro       : http://pro.rajaongkir.com/api
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
    | API Version (for account type basic and pro)
    |--------------------------------------------------------------------------
    | You can get API key in www.rajaongkir.com
    |
    */

    'api_version' => env('RAJAONGKIR_API_VERSION', 'v2'),
    /*
    |--------------------------------------------------------------------------
    | For Caching
    |--------------------------------------------------------------------------
    | You are free to change the cache configuration.
    | province_table for name table of province
    | city_table for name table of city
    | cache_type for type of cache
    |
    | Cache supported database,and file. If you can't use cache, set value to null
    */
    
    'province_table' => env('RAJAONGKIR_PROV_TABLE', 'ro_province'),

    'city_table' => env('RAJAONGKIR_CITY_TABLE', 'ro_city'),

    'subdistrict_table' => env('RAJAONGKIR_SUBDISTRICT_TABLE', 'ro_subdistrict'),

    'cache_type' => env('RAJAONGKIR_CACHE', 'database'),

];
