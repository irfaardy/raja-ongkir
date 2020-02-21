<?php 
/* 
	Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/
namespace Irfa\RajaOngkir\Ongkir\Func;

class Api {

	 private static $account_type;
	 private static $api_key;
	 private static $count=0;

	 function __construct(){

	 		
	 }
	 private static function setup_option(){
	 	if(function_exists('config') AND function_exists('app')){//Load Config For Laravel
	 		self::$account_type = config('irfa.rajaongkir.account_type');
	 		self::$api_key = config('irfa.rajaongkir.api_key');
	 	} else{//For PHP Native
	 		require(__DIR__."../../../../config/config.php");
	 		self::$account_type =$config['account_type'];
	 		self::$api_key = $config['api_key'];
	 	}

	 }
	 protected static function get_province($arr = null){
	 	if($arr != null){
	 		$province_id = array_key_exists('province_id', $arr)?"?id=".$arr['province_id']:null;
	 	} else {
	 		$province_id = null;
	 	}
	 	self::setup_option();
	 	$curl = curl_init();
	 	 curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/".self::$account_type."/province".$province_id,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: ".self::$api_key
		  ),
		));
		$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  $res = json_decode($response,false)->rajaongkir->results;
			 

			  return $res;
			}
	 }
	 protected static function get_city($arr=null){
	 	if($arr != null){
	 		$province_id = array_key_exists('province_id', $arr)?"?province=".$arr['province_id']:null;
	 	} else {
	 		$province_id = null;
	 	}
	 	self::setup_option();
	 	$curl = curl_init();
	 	 curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/".self::$account_type."/city".$province_id,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: ".self::$api_key
		  ),
		));
		$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  $res = json_decode($response,false)->rajaongkir->results;
			 

			  return $res;
			}
	 }
	 protected static function get_courier($arr){
			$origin = $arr['origin'];
			$destination = $arr['destination'];
			$weight = $arr['weight'];
			$courier = $arr['courier'];
			$res = self::curl_cost_get($origin,$destination,$weight,$courier);

	  		return $res;
	            
	       
	    }

	protected static function get_cost_details($arr){
			$origin = $arr['origin'];
			$destination = $arr['destination'];
			$weight = $arr['weight'];
			$courier = $arr['courier'];
			$res = self::curl_cost_get($origin,$destination,$weight,$courier);

			return $res{0}->costs;
	}

	private static function curl_cost_get($origin,$destination,$weight,$courier){
				$curl = curl_init();

	            curl_setopt_array($curl, self::curl_cost_option($origin,$destination,$weight,$courier));

	            $response = curl_exec($curl);
	            $err = curl_error($curl);

	            curl_close($curl);

	            if ($err) {
	              return "cURL Error #:" . $err;
	            } else {
	               
	             
	        		$res = json_decode($response,false)->rajaongkir->results;
	        		return $res;
				}
	}
	private static function curl_cost_option($origin,$destination,$weight,$courier){
		self::setup_option();
		// self::$api_key = 'cd241c22aa5365c37e2464bdbe7b880e';
		return array(
	              CURLOPT_URL => 'https://api.rajaongkir.com/'.self::$account_type.'/cost',
	              CURLOPT_RETURNTRANSFER => true,
	              CURLOPT_ENCODING => "",
	              CURLOPT_MAXREDIRS => 10,
	              CURLOPT_TIMEOUT => 30,
	              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	              CURLOPT_CUSTOMREQUEST => "POST",
	              CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$destination."&weight=".$weight."&courier=".strtolower($courier),
	              CURLOPT_HTTPHEADER => array(
	                "content-type: application/x-www-form-urlencoded",
	                "key: ".self::$api_key
	              ),
	            );
	}
}


 