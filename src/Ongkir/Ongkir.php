<?php 
/* 
	Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/
namespace Irfa\RajaOngkir\Ongkir;

use Irfa\RajaOngkir\Ongkir\Func\Api;
use Irfa\RajaOngkir\Caching\ROCache;
use Exception;

class Ongkir extends Api {

	 private static $arr;
	 private static $return;

	 public static function find($arr) {
	 	if (is_array($arr)) {
	 		self::$arr = $arr;
	 	 	return new static();
	 	 } else {
	 	 	 throw new Exception("Parameter must be an array.");
	 	 	 return false;
	 	 }
	       	
		}
	 public static function get() {
	 	if (empty(self::$return)) {
	 	  throw new Exception("Data is not defined.");
	 	 	return false;
	 	};
	 	return self::$return;
	 }
	 public static function cachingProvince() {
	 	self::cacheProvince();
	 } 
	 public static function cachingCity() {
	 	self::cacheCity();
	 }

	 public static function costDetails() {
	 	self::$return = self::get_cost_details(self::$arr);
	 	return new static();
	 } 

	 public static function courier() {
	 	self::$return = self::get_courier(self::$arr);
	 	return new static();
	 }

	 public static function province() {
	 	if (function_exists('config') AND function_exists('app')) {
	 		$cache_type = strtolower(config('irfa.rajaongkir.cache_type'));
	 		if ($cache_type == 'database') {
	 			if (ROCache::checkProv()) {
	 				if (count(ROCache::getProv(self::$arr)) > 0) {
	 					$ret = ROCache::getProv(self::$arr);
	 				} else {
	 					$ret = self::get_province(self::$arr);
	 				}
	 			}
	 		} elseif ($cache_type == 'file') {
	 			$ret = ROCache::cacheFile(config('irfa.rajaongkir.province_table'), self::$arr);
	 			if ($ret == null) {
	 				throw new Exception("Cache is empty.");
	 	 	 		return false;
	 			}

	 		} else {
	 			$ret = self::get_province(self::$arr);
	 		}
	 	} else {
	 			$ret = self::get_province(self::$arr);
	 		}
	 		self::$return = $ret;
	 		return new static();
	 	 	
	 }

	 public static function city() {
		if (function_exists('config') AND function_exists('app')) {
	 		$cache_type = strtolower(config('irfa.rajaongkir.cache_type'));
	 		if ($cache_type == 'database') {
	 			if (ROCache::checkCity()) {
	 				if (count(ROCache::getCity(self::$arr)) > 0) {
	 					$ret = ROCache::getCity(self::$arr);
	 				} else {
	 					$ret = self::get_city(self::$arr);
	 				}
	 			}
	 		} elseif ($cache_type == 'file') {
	 			$ret = ROCache::cacheFile(config('irfa.rajaongkir.city_table'), self::$arr);
	 			if ($ret == null) {
	 				throw new Exception("Cache is empty. Try php artisan raja-ongkir:cache");
	 	 	 		return false;
	 			}
	 		} else {
	 			$ret = self::get_city(self::$arr);
	 		}
	 	} else {
	 			$ret = self::get_city(self::$arr);
	 		}
	 	 	self::$return = $ret;
	 	 	return new static();
	 }
}
