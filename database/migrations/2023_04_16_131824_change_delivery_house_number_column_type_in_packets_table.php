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
        Schema::table('packets', function (Blueprint $table) {
            $table->string('delivery_house_number')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('packets', function (Blueprint $table) {
            $table->integer('delivery_house_number')->change();
        });
    }
};
