<?php

/*
    Raja Ongkir API
    Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/

namespace Irfa\RajaOngkir\Ongkir\Func;

use Exception;
use Irfa\RajaOngkir\Caching\CacheCurl;

class Api extends CacheCurl
{
    private static $account_type;
    private static $api_key;
    private static $url;
    private static $count = 0;

    public function __construct()
    {
    }

    private static function setup_option()
    {
        if (function_exists('config') and function_exists('app')) {//Load Config For Laravel
            self::$account_type = strtolower(config('irfa.rajaongkir.account_type'));
            self::$api_key = config('irfa.rajaongkir.api_key');
        } else {//Load config For PHP Native
            require __DIR__.'../../../../config/config.php';
            self::$account_type = strtolower($config['account_type']);
            self::$api_key = $config['api_key'];
        }
        if (self::$account_type == 'pro') {
            self::$url = 'https://pro.rajaongkir.com/api';
        } else {
            self::$url = 'https://api.rajaongkir.com/'.self::$account_type;
        }
    }

    protected static function cacheProvince()
    {
        self::setup_option();
        echo "Retrieving data from \033[96m".self::$url."...\033[0m".PHP_EOL;
        CacheCurl::caching(self::get_province())->province();
    }

    protected static function cacheCity()
    {
        self::setup_option();
        echo "Retrieving data from\033[96m ".self::$url."...\033[0m".PHP_EOL;
        CacheCurl::caching(self::get_city())->city();
    }

    protected static function get_province($arr = null)
    {
        if ($arr != null) {
            $province_id = array_key_exists('province_id', $arr) ? '?id='.$arr['province_id'] : null;
        } else {
            $province_id = null;
        }
        self::setup_option();
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => self::$url.'/province'.$province_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'key: '.self::$api_key,
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Can't connect to server, please check your internet connection.";
            exit();
        } else {
            $json = json_decode($response, false)->rajaongkir;
            if ($json->status->code == '400') {
                throw new Exception($json->status->description);
            } else {
                $res = $json->results;

                return $res;
            }
        }
    }

    protected static function get_city($arr = null)
    {
        if ($arr != null) {
            $province_id = array_key_exists('province_id', $arr) ? '?province='.$arr['province_id'] : null;
        } else {
            $province_id = null;
        }
        self::setup_option();
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => self::$url.'/city'.$province_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'key: '.self::$api_key,
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Can't connect to server, please check your internet connection.";
            exit();
        } else {
            $json = json_decode($response, false)->rajaongkir;
            if ($json->status->code == '400') {
                throw new Exception($json->status->description);
            } else {
                $res = $json->results;

                return $res;
            }
        }
    }

    protected static function get_courier($arr)
    {
        $origin = $arr['origin'];
        $destination = $arr['destination'];
        $weight = $arr['weight'];
        $courier = $arr['courier'];
        $res = self::curl_cost_get($origin, $destination, $weight, $courier);

        return $res;
    }

    protected static function get_cost_details($arr)
    {
        $origin = $arr['origin'];
        $destination = $arr['destination'];
        $weight = $arr['weight'];
        $courier = $arr['courier'];
        $res = self::curl_cost_get($origin, $destination, $weight, $courier);

        return $res[0]->costs;
    }

    private static function curl_cost_get($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, self::curl_cost_option($origin, $destination, $weight, $courier));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Can't connect to server, please check your internet connection.";
            exit();
        } else {
            $json = json_decode($response, false)->rajaongkir;
            if ($json->status->code == '400') {
                throw new Exception($json->status->description);
            } else {
                $res = $json->results;

                return $res;
            }
        }
    }

    private static function curl_cost_option($origin, $destination, $weight, $courier)
    {
        self::setup_option();

        return [
            CURLOPT_URL            => self::$url.'/cost',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => 'origin='.$origin.'&destination='.$destination.'&weight='.$weight.'&courier='.strtolower($courier),
            CURLOPT_HTTPHEADER     => [
                'content-type: application/x-www-form-urlencoded',
                'key: '.self::$api_key,
            ],
        ];
    }
}
