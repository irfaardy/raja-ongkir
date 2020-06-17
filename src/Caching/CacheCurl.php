<?php

namespace Irfa\RajaOngkir\Caching;

use Illuminate\Support\Facades\Cache;

class CacheCurl extends DBImport
{
    private static $bucket;
    private static $table;
    private static $type;

    protected static function caching($results)
    {
        self::$bucket = $results;

        return new static();
    }

    private static function _import()
    {
        $cache_type = strtolower(config('irfa.rajaongkir.cache_type'));
        if ($cache_type == 'file') {
            Cache::store('file')->put('ro-cache-'.self::$table, self::$bucket);
            echo'Cache has been created. '.self::formatBytes(strlen(serialize(Cache::get('ro-cache-'.self::$table))));
        } elseif ($cache_type == 'database') {
            self::import(self::$table, self::$bucket, self::$type);
        } elseif ($cache_type == null) {
            echo'Please set cache type.';
        } else {
            echo'Cache type is not supported.';
        }
        self::$bucket = null;
        self::$type = null;
        self::$table = null;
    }

    protected static function province()
    {
        self::$table = config('irfa.rajaongkir.province_table');
        self::$type = 'prov';
        self::_import();
    }

    protected static function city()
    {
        self::$table = config('irfa.rajaongkir.city_table');
        self::$type = 'city';
        self::_import();
    }

    protected static function subdistrict()
    {
        self::$table = config('irfa.rajaongkir.subdistrict_table');
        self::$type = 'subdistrict';
        self::_import();
    }

    private static function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB', 'TB'];

        return round(pow(1024, $base - floor($base)), $precision).' '.$suffixes[floor($base)];
    }
}
