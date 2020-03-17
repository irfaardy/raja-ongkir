<?php

declare(strict_types=1);
use Irfa\RajaOngkir\Facades\Ongkir;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function testProvince()
    {
        $o = Ongkir::getProvince();
        $this->assertFalse($o, null);
    }
}
