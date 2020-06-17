<?php

namespace Irfa\RajaOngkir\Caching;

use Illuminate\Support\Facades\DB;

class DBImport
{
    protected static $table_DB;

    protected static function import($table, $result, $type = 'prov')
    {
        self::$table_DB = $table;
        echo 'Creating cache... '.PHP_EOL;
        self::extractor($result, $type);
    }

    private static function extractor($result, $type)
    {
        try {
            foreach ($result as $r) {
                if ($type == 'prov') {
                    $fill = ['province_id' => $r->province_id, 'province' => $r->province];
                    $where = ['province_id' => $r->province_id];
                } elseif ($type == 'city') {
                    $fill = ['city_id'=>$r->city_id, 'province_id'=>$r->province_id, 'province' => $r->province, 'type'=>$r->type, 'city_name'=>$r->city_name, 'postal_code'=>$r->postal_code];
                    $where = ['city_id' => $r->city_id];
                } elseif ($type == 'subdistrict') {
                    $fill = ['subdistrict_id'=>$r->subdistrict_id, 'province_id'=>$r->province_id, 'province' => $r->province, 'city_id'=>$r->city_id, 'city'=>$r->city, 'type'=>$r->type,'subdistrict_name'=>$r->subdistrict_name];
                    $where = ['subdistrict_id' => $r->subdistrict_id];
                }
                if (DB::table(self::$table_DB)->where($where)->count() == 0) {
                    DB::table(self::$table_DB)->insert($fill);
                } else {
                    DB::table(self::$table_DB)->where($where)->update($fill);
                }
            }
            $count = DB::table(self::$table_DB)->count();
            echo 'Cache has been created, '.$count.' row(s) affected.';
        } catch (\Exception $e) {
            echo "\033[91mCan't creating cache. Error\033[0m : ".$e;
        }
    }
}
