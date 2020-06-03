<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ro_city', function (Blueprint $table) {
            $table->string('city_id', 20)->primary();
            $table->string('province_id', 20);
            $table->string('province', 120)->nullable();
            $table->string('type', 60)->nullable();
            $table->string('city_name', 128)->nullable();
            $table->string('postal_code', 15)->nullable();
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
        Schema::dropIfExists('ro_city');
    }
}
