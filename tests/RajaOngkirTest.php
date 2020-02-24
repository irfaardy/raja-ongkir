<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Irfa\RajaOngkir\Facades\Ongkir;

final class EmailTest extends TestCase
{

    public function testProvince()
    {
    	$o = Ongkir::getProvince();
        $this->assertFalse($o,null);
    }
}