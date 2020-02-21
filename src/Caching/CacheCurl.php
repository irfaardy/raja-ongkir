<?php 
namespace Irfa\RajaOngkir\Caching;

use Irfa\RajaOngkir\Caching\DBImport;

class CacheCurl extends DBImport
{
	private static $bucket;
	private static $table;
	private static $type;

	protected static function caching($results){
		self::$bucket = $results;
		return new static();
	}
	private static function _import(){
		self::import(self::$table,self::$bucket,self::$type);
	}
	protected static function province(){
		self::$table = config('irfa.rajaongkir.province_table');
		self::$type = 'prov';

		self::_import();
	}
	protected static function city(){
		self::$table = config('irfa.rajaongkir.city_table');
		self::$type = 'city';

		self::_import();
	}
	
	}