<?php

/*
    Raja Ongkir API
    Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/

namespace Irfa\RajaOngkir\Caching;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ROCache
{
    private static $prov;
    private static $city;

    public static function cacheFile($name, $find = null)
    {
        $cache = Cache::get('ro-cache-'.$name);
        if ($find != null) {
            $cache = collect($cache)->where('province_id', $find['province_id']);
        }

        return $cache;
    }

    public static function clearCache()
    {
        self::$prov = config('irfa.rajaongkir.province_table');
        self::$city = config('irfa.rajaongkir.city_table');
        $cache_type = strtolower(config('irfa.rajaongkir.cache_type'));
        if ($cache_type == 'database') {
            if (Schema::hasTable(self::$city) and Schema::hasTable(self::$prov)) {
                echo 'Clearing Cache...'.PHP_EOL;
                self::clearTable();
                echo 'Cache Cleared.';
            } else {
                echo 'Failed. Cache table not found.';

                return false;
            }
        } elseif ($cache_type == 'file') {
            echo 'Clearing Cache...'.PHP_EOL;
            self::clearFile();
            echo 'Cache Cleared.';
        } else {
            echo 'Failed. Cache type not support.';

            return false;
        }
        self::$prov = null;
        self::$city = null;
    }

    private static function clearTable()
    {
        DB::table(self::$prov)->truncate();
        DB::table(self::$city)->truncate();
    }

    private static function clearFile()
    {
        Cache::forget('ro-cache-'.self::$city);
        Cache::forget('ro-cache-'.self::$prov);
    }

    public static function checkProv()
    {
        $table = config('irfa.rajaongkir.province_table');
        if (Schema::hasTable($table)) {
            $count = DB::table($table)->count();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function checkCity()
    {
        $table = config('irfa.rajaongkir.city_table');
        if (Schema::hasTable($table)) {
            $count = DB::table($table)->count();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function getProv($arr)
    {
        $db = DB::table(config('irfa.rajaongkir.province_table'));
        if (!empty($arr)) {
            $db->where($arr);
        }
        $ret = $db->orderBy('province', 'DESC')->get();

        return $ret;
    }

    public static function getSubdistrict($arr)
    {
        $db = DB::table(config('irfa.rajaongkir.subdistrict_table'));
        if (!empty($arr)) {
            $db->where($arr);
        }
        $ret = $db->orderBy('subdistrict_name', 'DESC')->get();

        return $ret;
    }

    public static function getCity($arr)
    {
        $db = DB::table(config('irfa.rajaongkir.city_table'));
        if (!empty($arr)) {
            $db->where($arr);
        }
        $ret = $db->orderBy('city_name', 'ASC')->get();

        return $ret;
    }
}
