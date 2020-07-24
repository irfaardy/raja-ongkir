<?php

/*
    Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/

namespace Irfa\RajaOngkir\Ongkir;

use Exception;
use Irfa\RajaOngkir\Caching\ROCache;
use Irfa\RajaOngkir\Ongkir\Func\Api;

class Ongkir extends Api
{
    private static $arr;
    private static $return;
    private static $province;
    private static $city;
    private static $cacheType;

    public static function find($arr)
    {
        if (is_array($arr)) {
            self::$arr = $arr;

            return new static();
        } else {
            throw new Exception('Parameter must be an array.');

            return false;
        }
    }

    public static function get()
    {
        self::$arr = null; //Clear parameter
        if (empty(self::$return)) {
            throw new Exception('Data is not defined.');

            return false;
        }
        $ret = self::$return;
        self::$return = null;

        return $ret;
    }

    public static function cachingProvince()
    {
        self::cacheProvince();
    }

     public static function cachingSubDistrict()
    {
        if(strtolower(config('irfa.rajaongkir.account_type')) == "starter")
        {
             echo "Tidak dapat mengambil SubDistrict dikarenakan akun yg anda pakai tipe starter.";
             return true;
        }
        $get = self::cityData();
        $count = count($get);
        $i=0;
        echo PHP_EOL."\033[42mThis may take longer, please wait.\033[0m";
        foreach($get as $city){
            $i++;
             echo PHP_EOL."Remaining City\033[96m ".$i."/".$count."\033[0m";
             echo PHP_EOL."Get Subdistrict\033[96m ".$city->city_name."...\033[0m".PHP_EOL;
             self::cacheSubDistrict(['city' =>  $city->city_id]);
             echo PHP_EOL;
        }
    }

    public static function cachingCity()
    {
        self::cacheCity();
    }

    public static function costDetails()
    {
        self::$return = self::get_cost_details(self::$arr);

        return new static();
    } 
    public static function testConnection()
    {
        self::$return = self::test_connection(self::$arr);

        return new static();
    }

    public static function courier()
    {
        self::$return = self::get_courier(self::$arr);

        return new static();
    }
   
    public static function province()
    {
        $ret = self::provinceData();
        self::$return = $ret;

        return new static();
    } 

    public static function subDistrict()
    {
        $ret = self::subDistrictData();
        self::$return = $ret;

        return new static();
    }
    public static function internationalOrigin()
    {
        $ret = self::internationalOriginData();
        self::$return = $ret;

        return new static();
    }

    public static function city()
    {
        $ret = self::cityData();
        self::$return = $ret;

        return new static();
    }

    private static function setupConfig()
    {
        self::$cacheType = strtolower(config('irfa.rajaongkir.cache_type'));
        self::$province = config('irfa.rajaongkir.province_table');
        self::$city = config('irfa.rajaongkir.city_table');
    }

    private static function provinceData()
    {
        if (function_exists('config') && function_exists('app')) {
            self::setupConfig();
            $cache_type = self::$cacheType;
            if ($cache_type == 'database') {
                if (ROCache::checkProv()) {
                    if (count(ROCache::getProv(self::$arr)) > 0) {
                        $ret = ROCache::getProv(self::$arr);
                    } else {
                        $ret = self::get_province(self::$arr);
                    }
                }
            } elseif ($cache_type == 'file') {
                $ret = ROCache::cacheFile(self::$province, self::$arr);
                if ($ret == null) {
                    self::exceptionCache();
                }
            } else {
                $ret = self::get_province(self::$arr);
            }
        } else {
            $ret = self::get_province(self::$arr);
        }

        return $ret;
    }
    private static function subDistrictData()
    {
        if (function_exists('config') && function_exists('app')) {
            self::setupConfig();
            $cache_type = self::$cacheType;
            if ($cache_type == 'database') {
                if (ROCache::checkProv()) {
                    if (count(ROCache::getSubdistrict(self::$arr)) > 0) {
                        $ret = ROCache::getSubdistrict(self::$arr);
                    } else {
                        $ret = self::getSubdistrict(self::$arr);
                    }
                }
            } elseif ($cache_type == 'file') {
                $ret = ROCache::cacheFile(self::$province, self::$arr);
                if ($ret == null) {
                    self::exceptionCache();
                }
            } else {
                $ret = self::getSubdistrict(self::$arr);
            }
        } else {
            $ret = self::getSubdistrict(self::$arr);
        }

        return $ret;
    }
    private static function internationalOriginData()
    {
        
            $ret = self::get_international_origin(self::$arr);
     

        return $ret;
    }
    private static function cityData()
    {
        if (function_exists('config') && function_exists('app')) {
            self::setupConfig();
            $cache_type = self::$cacheType;
            if ($cache_type == 'database') {
                if (ROCache::checkCity()) {
                    if (count(ROCache::getCity(self::$arr)) > 0) {
                        $ret = ROCache::getCity(self::$arr);
                    } else {
                        $ret = self::get_city(self::$arr);
                    }
                }
            } elseif ($cache_type == 'file') {
                $ret = ROCache::cacheFile(self::$city, self::$arr);
                if ($ret == null) {
                    self::exceptionCache();
                }
            } else {
                $ret = self::get_city(self::$arr);
            }
        } else {
            $ret = self::get_city(self::$arr);
        }

        return $ret;
    }

    private static function exceptionCache()
    {
        throw new Exception('Cache file is empty. Try php artisan raja-ongkir:cache');

        return false;
    }
}
