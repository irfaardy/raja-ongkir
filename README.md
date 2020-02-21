



# Raja Ongkir Laravel
[![Latest Stable Version](https://poser.pugx.org/irfa/raja-ongkir/v/stable?format=flat-square) ](https://packagist.org/packages/irfa/raja-ongkir)[![License](https://poser.pugx.org/irfa/raja-ongkir/license?format=flat-square)](https://packagist.org/packages/irfa/raja-ongkir)
<h3>Installation with Composer</h3>

    composer require irfa/raja-ongkir

>You can get Composer [ here]( https://getcomposer.org/download/)

***


<h3>PHP Native Setup</h3>
  

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
<h3> Laravel Setup </h3>

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

  <h3>Publish Config File</h3>


    php artisan vendor:publish

Open .env file add 

    ....
    RAJAONGKIR_ACCOUNT_TYPE = starter
    RAJAONGKIR_API_KEY = your-api-key
  ***
  <h3>Usage</h3>

      use RajaOngkir;

 **Get all province**

     $get = RajaOngkir::getProvince();
     foreach($get as $prov):
    
		echo $prov->province_id."<br>"; // value = 1
		echo $prov->province."<br>";// value = Bali
		
		
    endforeach;
**Search province**

 

       $get = RajaOngkir::find(['province_id' => 1])->getProvince();
         
    	echo $get->province_id."<br>"; // value = 1
    	echo $get->province."<br>";// value = Bali
	
   
**Get all City** 

    $get = RajaOngkir::getCity();
    foreach($get as $city):
    
		echo $city->city_id."<br>"; // value = 17
		echo $city->province_id."<br>";// value = 1
		echo $city->province."<br>";// value = Bali
		echo $city->type."<br>"; // value = Kabupaten
		echo $city->city_name."<br>"; // value = Badung
		echo $city->postal_code."<br>"; // value = 80351
		
    endforeach;
    
**Get all City in province** 

    
    $get = RajaOngkir::find(['province_id' => 1])->getCity();
    foreach($get as $city):
    
		echo $city->city_id."<br>"; // value = 17
		echo $city->province_id."<br>";// value = 1
		echo $city->province."<br>";// value = Bali
		echo $city->type."<br>"; // value = Kabupaten
		echo $city->city_name."<br>"; // value = Badung
		echo $city->postal_code."<br>"; // value = 80351
		
    endforeach;
   **Get courier**
   

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
	  
**Example  cost Courier** 
   

     $params = ['origin'=>1,'destination'=>2,'weight'=>1000,'courier' => 'jne'
    			   ]
     foreach(RajaOngkir::find($params)->getCostDetails() as $cost):


     
    	echo "Service: ".$cost->service."<br>";
    	echo "Description: ".$cost->description."<br>";
    	
    	foreach($cost->cost as $detail){
    		echo "Value: ".$detail->value."<br>";
    		echo "Estimasi: ".$detail->etd."<br>";
    		echo "Note: ".$detail->note."<br>";
    		echo "<hr>";
    	}
    endforeach;


