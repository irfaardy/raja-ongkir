<?php 
/* 
	Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/
namespace Irfa\RajaOngkir\Ongkir;

use Irfa\RajaOngkir\Ongkir\Func\Api;
use Irfa\RajaOngkir\Ongkir\Func\ROCache;
use Exception;

class Ongkir extends Api{

	 private static $arr;

	 public static function find($arr){
	 	if(is_array($arr)){
	 		self::$arr = $arr;
	 	 	return new static();
	 	 } else{
	 	 	 throw new Exception("Parameter must be an array.");
	 	 	 return false;
	 	 }
	       	
	    }

	 public static function cachingProvince(){
	 	self::cacheProvince();
	 } 
	 public static function cachingCity(){
	 	self::cacheCity();
	 }

	 public static function getCostDetails(){
	 	return self::get_cost_details(self::$arr);
	 } 

	 public static function getCourier(){
	 	return self::get_courier(self::$arr);
	 }

	 public static function getProvince(){
	 	if(function_exists('config') AND function_exists('app')){
	 		$cache_type = strtolower(config('irfa.rajaongkir.cache_type'));
	 		if($cache_type == 'database'){
	 			if(ROCache::checkProv()){
	 				if(count(ROCache::getProv(self::$arr)) > 0){
	 					$ret = ROCache::getProv(self::$arr);
	 				} else{
	 					$ret = self::get_province(self::$arr);
	 				}
	 			}
	 		} elseif($cache_type == 'file'){
	 			$ret = ROCache::cacheFile(config('irfa.rajaongkir.province_table'),self::$arr);
	 			if($ret == null){
	 				throw new Exception("Cache is empty.");
	 	 	 		return false;
	 			}

	 		} else{
	 			$ret = self::get_province(self::$arr);
	 		}
	 	}  else{
	 			$ret = self::get_province(self::$arr);
	 		}
	 	 	return $ret;
	 }

	 public static function getCity(){
		if(function_exists('config') AND function_exists('app')){
	 		$cache_type = strtolower(config('irfa.rajaongkir.cache_type'));
	 		if($cache_type == 'database'){
	 			if(ROCache::checkCity()){
	 				if(count(ROCache::getCity(self::$arr)) > 0){
	 					$ret = ROCache::getCity(self::$arr);
	 				} else{
	 					$ret = self::get_city(self::$arr);
	 				}
	 			}
	 		} elseif($cache_type == 'file'){
	 			$ret = ROCache::cacheFile(config('irfa.rajaongkir.city_table'),self::$arr);
	 			if($ret == null){
	 				throw new Exception("Cache is empty.");
	 	 	 		return false;
	 			}
	 		} else{
	 			$ret = self::get_city(self::$arr);
	 		}
	 	}  else{
	 			$ret = self::get_city(self::$arr);
	 		}
	 	 	return $ret;
	 }
}
