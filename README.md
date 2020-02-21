# Raja Ongkir Laravel Package
[![License](https://poser.pugx.org/irfa/raja-ongkir/license?format=flat)](https://packagist.org/packages/irfa/raja-ongkir)
<h3>Installation with Composer</h3>

    composer require irfa/raja-ongkir

>You can get Composer [ here]( https://getcomposer.org/download/)

***


<h2>PHP Native Setup</h2>
  

      <?php 
         require "vendor/autoload.php";
            
         use Irfa\RajaOngkir\Ongkir\Ongkir as RajaOngkir;
         ....
<b>Configuration File</b>

> **Config location :** vendor/irfa/raja-ongkir/config/config.php

    <?php
    	$config = [
    		'account_type' => 'your-account-type',
    
    		'api_key' => 'your-api-key',
    	];

> You can get API key in [Raja Ongkir](https://rajaongkir.com/).
> Account type supported : starter, basic, and pro.


***
<h2> Laravel Setup </h2>

<h3>Add to config/app.php</h3>

    'providers' => [
	      ....
	         Irfa\RajaOngkir\RajaOngkirServiceProvider::class, 
         ];



<h3>Add to config/app.php</h3>

    'aliases' => [
             ....
	    'RajaOngkir' => Irfa\RajaOngkir\Facades\Ongkir::class,
    
        ],

  <h2>Publish Vendor</h2>


    php artisan vendor:publish --tag=raja-ongkir

Open .env file add 

    ....
    RAJAONGKIR_ACCOUNT_TYPE = starter
    RAJAONGKIR_API_KEY = your-api-key
  ***
<h2>Caching</h2>

> Caching is useful for loading city and province faster.

Migrating table city and provinsi

    php artisan migrate
**Caching Province and City**<br>
Open console/cmd and run

    php artisan raja-ongkir:cache
**Caching City**<br>
Open console/cmd and run

    php artisan raja-ongkir:city-cache
**Caching Province**<br>
Open console/cmd and run

    php artisan raja-ongkir:prov-cache
**Clear Cache**<br>
Open console/cmd and run

    php artisan raja-ongkir:clear
***
  <h3>Usage</h3>

      use RajaOngkir;

 **Retrieve all province**

     $get = RajaOngkir::getProvince();
     foreach($get as $prov):
    
		echo $prov->province_id."<br>"; // value = 1
		echo $prov->province."<br>";// value = Bali
		
		
    endforeach;
**Search province**

 

       $get = RajaOngkir::find(['province_id' => 1])->getProvince();
         
    	echo $get->province_id."<br>"; // value = 1
    	echo $get->province."<br>";// value = Bali
	
   
**Retrieve all City** 

    $get = RajaOngkir::getCity();
    foreach($get as $city):
    
		echo $city->city_id."<br>"; // value = 17
		echo $city->province_id."<br>";// value = 1
		echo $city->province."<br>";// value = Bali
		echo $city->type."<br>"; // value = Kabupaten
		echo $city->city_name."<br>"; // value = Badung
		echo $city->postal_code."<br>"; // value = 80351
		
    endforeach;
    
**Retrieve all city in province** 

    
    $get = RajaOngkir::find(['province_id' => 1])->getCity();
    foreach($get as $city):
    
		echo $city->city_id."<br>"; // value = 17
		echo $city->province_id."<br>";// value = 1
		echo $city->province."<br>";// value = Bali
		echo $city->type."<br>"; // value = Kabupaten
		echo $city->city_name."<br>"; // value = Badung
		echo $city->postal_code."<br>"; // value = 80351
		
    endforeach;
   **Retrieve courier**
   

      $get = RajaOngkir::find(['origin'=>1,
				    'destination'=>2,
				    'weight'=>1000,//1000gr
				    'courier' => 'jne'
				   ])
		->getCourier();
	  foreach($get as $city):
    
		echo $city->code."<br>"; // value = jne
		echo $city->name."<br>";// value = Jalur Nugraha Ekakurir (JNE)
		
	  endforeach;
	  
**Retrieve  cost courier** 
   

     $params = ['origin'=>1,'destination'=>2,'weight'=>1000,'courier' => 'jne'
    			   ];
	     $get = RajaOngkir::find($params)->getCostDetails();
	     foreach($get as $cost):


     
    	echo "Service: ".$cost->service."<br>";
    	echo "Description: ".$cost->description."<br>";
    	
    	foreach($cost->cost as $detail):
    		echo "Value: ".$detail->value."<br>";
    		echo "Estimasi: ".$detail->etd."<br>";
    		echo "Note: ".$detail->note."<br>";
    		echo "<hr>";
    	endforeach;
    endforeach;


