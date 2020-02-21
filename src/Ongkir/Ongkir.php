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
	 		if(ROCache::checkProv()){
	 			$ret = ROCache::getProv(self::$arr);
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
	 		if(ROCache::checkCity()){
	 			if(count(ROCache::getCity(self::$arr)) > 0){
	 				$ret = ROCache::getCity(self::$arr);
	 			} else{

	 				$ret = self::get_city(self::$arr);
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
