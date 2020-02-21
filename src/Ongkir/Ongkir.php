<?php 
/* 
	Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/

namespace Irfa\RajaOngkir\Ongkir;

use Irfa\RajaOngkir\Ongkir\Func\Api;

class Ongkir extends Api{

	 private static $arr;

	 public static function find($arr){
	 		self::$arr = $arr;
	 	 	return new static();
	       	
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
