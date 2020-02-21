<?php 
/* 
	Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/
namespace Irfa\RajaOngkir\Ongkir;

use Irfa\RajaOngkir\Ongkir\Func\Api;
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
	 public static function getCostDetails(){
	 	return self::get_cost_details(self::$arr);
	 } 

	 public static function getCourier(){
	 	return self::get_courier(self::$arr);
	 }

	 public static function getProvince(){

	 	 	return self::get_province(self::$arr);
	 }

	 public static function getCity(){

	 	 	return self::get_city(self::$arr);
	 }
}
