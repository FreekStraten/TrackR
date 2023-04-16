<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up() : void
    {
        Schema::table('packets', function (Blueprint $table) {
            $table->string('delivery_driver')->nullable();
            $table->foreign('delivery_driver')
                ->references('name')
                ->on('delivery_drivers')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('packets', function (Blueprint $table) {
            $table->dropForeign(['delivery_driver']);
            $table->dropColumn('delivery_driver');
        });
    }

};
