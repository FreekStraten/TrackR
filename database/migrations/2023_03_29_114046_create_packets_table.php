<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('packets', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('tracking_number');
            $table->string('format');
            $table->integer('weight');
            $table->string('shipping_street');
            $table->string('shipping_house_number');
            $table->string('shipping_city');
            $table->string('shipping_zip_code');
            $table->string('delivery_street');
            $table->integer('delivery_house_number');
            $table->string('delivery_city');
            $table->string('delivery_zip_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('packets');
    }
};
