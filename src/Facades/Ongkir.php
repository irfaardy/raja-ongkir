<?php
/*
    Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/

namespace Irfa\RajaOngkir\Facades;

use Illuminate\Support\Facades\Facade;

class Ongkir extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Irfa\RajaOngkir\Ongkir\Ongkir::class;
    }
}
