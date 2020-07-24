# 🚀Raja Ongkir Laravel Package

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/irfaardy/raja-ongkir/badges/quality-score.png?b=master) ](https://scrutinizer-ci.com/g/irfaardy/raja-ongkir/?branch=master)[![Build Status](https://scrutinizer-ci.com/g/irfaardy/raja-ongkir/badges/build.png?b=master)](https://scrutinizer-ci.com/g/irfaardy/raja-ongkir/build-status/master)  [![StyleCI](https://github.styleci.io/repos/242054297/shield?branch=master)](https://github.styleci.io/repos/242054297) [![Latest Stable Version](https://poser.pugx.org/irfa/raja-ongkir/v/stable)](https://packagist.org/packages/irfa/raja-ongkir) ![PHP](https://github.com/irfaardy/raja-ongkir/workflows/PHP/badge.svg?branch=master)

<a href="https://www.buymeacoffee.com/OBaAofN" target="_blank"><img width="130px" src="https://cdn.buymeacoffee.com/buttons/lato-red.png" alt="Buy Me A Coffee"  ></a>


Package ini berguna untuk mengecek biaya ongkos kirim dari kurir, package ini dapat digunakan di Laravel 5/6/7 atau PHP Native.
**(untuk saat ini hanya mendukung tipe akun starter)**


<h3>🛠️ Installation with Composer </h3>

```php
composer require irfa/raja-ongkir
```

>You can get Composer [ here]( https://getcomposer.org/download/)




<h2>🛠️ PHP Native Setup</h2>


```php
  <?php 
     require "vendor/autoload.php";
        
     use Irfa\RajaOngkir\Ongkir\Ongkir as RajaOngkir;
     ....
```

<b>Configuration File</b>

> **Config location :** vendor/irfa/raja-ongkir/config/config.php

```php
<?php
	$config = [
		'account_type' => 'your-account-type',

		'api_key' => 'your-api-key',
	];
```

> You can get API key in [Raja Ongkir](https://rajaongkir.com/).<br> Account type supported : starter.

***

<h2>🛠️ Laravel Setup </h2>

<h3>Add to config/app.php</h3>

```php
'providers' => [
      ....
         Irfa\RajaOngkir\RajaOngkirServiceProvider::class, 
     ];
```



<h3>Add to config/app.php</h3>

```php
'aliases' => [
         ....
    'RajaOngkir' => Irfa\RajaOngkir\Facades\Ongkir::class,

    ],
```

  <h2>Publish Vendor</h2>


```php
php artisan vendor:publish --tag=raja-ongkir
```

Open .env file and add this line

    ....
    RAJAONGKIR_ACCOUNT_TYPE=starter
    RAJAONGKIR_API_KEY=your-api-key
    RAJAONGKIR_PROV_TABLE=ro_province
    RAJAONGKIR_CITY_TABLE=ro_city
    RAJAONGKIR_CACHE=database

***

<h2>🚀 Caching</h2>

> Caching is useful for loading city and province faster🚀.<br>You can change cache type in ***config/irfa/rajaongkir.php or project_name/.env***. <br>**This function currently only supports the Laravel Framework**<br><br>**Cache support :**  database and file<br> ( if you don't want to use cache you can set it to *null* )


**Migrating table city and provinsi**

> If you want to use database cache, you must run migrate first. 

    php artisan migrate

<h3>Caching Province,Sub-District and City</h3><br>

Open console/cmd and run

    php artisan raja-ongkir:cache all

<h3>Caching City</h3><br>

Open console/cmd and run

    php artisan raja-ongkir:cache city

<h3>Caching Province</h3><br>

Open console/cmd and run

    php artisan raja-ongkir:cache province

<h3>Clear Cache</h3><br>

Open console/cmd and run

    php artisan raja-ongkir:cache clear

<h3>Refresh Cache</h3><br>

Clear old cache and create latest cache.<br>
Open console/cmd and run

    php artisan raja-ongkir:cache refresh

***

  <h3>💻 Usage</h3>

```php
  use RajaOngkir;
```

<h3>Retrieve all province</h3>

```php
 $get = RajaOngkir::province()->get();
 foreach($get as $prov)
 {
	echo $prov->province_id."<br>"; // value = 1
	echo $prov->province."<br>";// value = Bali
 }
```

<h3>Search province</h3>

 

```php
   $get = RajaOngkir::find(['province_id' => 1])->province()->get();
	echo $get->province_id."<br>"; // value = 1
	echo $get->province."<br>";// value = Bali
```

   

<h3>Retrieve all City</h3>

```php
$get = RajaOngkir::city()->get();
foreach($get as $city)
{
	echo $city->city_id."<br>"; // value = 17
	echo $city->province_id."<br>";// value = 1
	echo $city->province."<br>";// value = Bali
	echo $city->type."<br>"; // value = Kabupaten
	echo $city->city_name."<br>"; // value = Badung
	echo $city->postal_code."<br>"; // value = 80351
}
```

<h3>Retrieve all city in province</h3>


```php
    $get = RajaOngkir::find(['province_id' => 1])->city()->get();
    foreach($get as $city){
		echo $city->city_id."<br>"; // value = 17
		echo $city->province_id."<br>";// value = 1
		echo $city->province."<br>";// value = Bali
		echo $city->type."<br>"; // value = Kabupaten
		echo $city->city_name."<br>"; // value = Badung
		echo $city->postal_code."<br>"; // value = 80351
     }
```

  <h3>Retrieve courier</h3>


```php
  $get = RajaOngkir::find(['origin'=>1,'destination'=>2,'weight'=>1000,'courier' => 'jne'])
	 ->courier()->get();
  foreach($get as $city)
  {
	echo $city->code."<br>"; // value = jne
	echo $city->name."<br>";// value = Jalur Nugraha Ekakurir (JNE)
  }
```

<h3>Retrieve  cost courier</h3>


```php
 $params = ['origin'=>1,'destination'=>2,'weight'=>1000,'courier' => 'jne'
			   ];
     $get = RajaOngkir::find($params)->costDetails()->get();
     foreach($get as $cost)
     {
	echo "Courier Name: ".$cost->service."<br>";
	echo "Description: ".$cost->description."<br>";
	 foreach($cost->cost as $detail)
	 {
		echo "Harga: ".$detail->value."<br>";
		echo "Estimasi: ".$detail->etd."<br>";
		echo "Note: ".$detail->note."<br>";
		echo "<hr>";
	 }
      }
```

## How to Contributing?

1. Fork it (<https://github.com/irfaardy/raja-ongkir/fork>)
2. Commit your changes (`git commit -m 'New Feature'`)
3. Push to the branch (`git push origin master`)
4. Create a new Pull Request

***
## Bagaimana cara berkontribusi?

1. Lakukan fork di (<https://github.com/irfaardy/raja-ongkir/fork>)
2. Commit perubahan yang anda lakukan (`git commit -m 'Fitur Baru'`)
3. Push ke branch master (`git push origin master`)
4. Buat Pull Request baru

***
