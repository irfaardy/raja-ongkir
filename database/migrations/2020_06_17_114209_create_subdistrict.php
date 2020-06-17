<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubdistrict extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ro_subdistrict', function (Blueprint $table) {
            $table->string('subdistrict_id',20)->primary();
            $table->string('province_id',20);
            $table->string('province',120)->nullable();
            $table->string('city_id',20)->nullable();
            $table->string('city',128)->nullable();
            $table->string('type',60)->nullable();
            $table->string('subdistrict_name',160)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ro_subdistrict');
    }
}
