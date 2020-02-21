<?php 
/* 
	Raja Ongkir API
	Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/
namespace Irfa\RajaOngkir\Ongkir\Func;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Exception;

class ROCache {

	public static function clearCache(){
		$prov = config('irfa.rajaongkir.province_table');
		$city = config('irfa.rajaongkir.city_table');
		if(Schema::hasTable($city) AND Schema::hasTable($prov)){
			echo "Clearing Cache...".PHP_EOL;
			$count = DB::table($prov)->truncate();
			$count = DB::table($city)->truncate();
			echo "Cache Cleared.";
		} else{
			echo "Failed.";
			return false;
		}
	}
	public static function checkProv(){
		$table = config('irfa.rajaongkir.province_table');
		if(Schema::hasTable($table)){
			$count = DB::table($table)->count();
			if($count > 0){
				return true;
			} else {
				return false;
			}
		} else{
			return false;
		}
	}
	public static function checkCity(){
		$table = config('irfa.rajaongkir.city_table');
		if(Schema::hasTable($table)){
			$count = DB::table($table)->count();
			if($count > 0){
				return true;
			} else {
				return false;
			}
		} else{
			return false;
		}
	}
	public static function getProv($arr){
		 $db = DB::table(config('irfa.rajaongkir.province_table'));
		 if(!empty($arr)){
		 	$db->where($arr);
		 }
		 $ret = $db->orderBy('province','DESC')->get();
		return $ret;
	}
	public static function getCity($arr){
		 $db = DB::table(config('irfa.rajaongkir.city_table'));
		 if(!empty($arr)){
		 	$db->where($arr);
		 }
		 $ret = $db->orderBy('city_name','ASC')->get();
		return $ret;
	}
}

