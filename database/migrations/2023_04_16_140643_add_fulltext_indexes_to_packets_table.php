<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('packets', function (Blueprint $table) {
            //add full text
            DB::statement('ALTER TABLE packets ADD FULLTEXT fulltext_i_delivery(delivery_street, delivery_house_number, delivery_city, delivery_zip_code)');
            DB::statement('ALTER TABLE packets ADD FULLTEXT fulltext_i_shipping(shipping_street, shipping_house_number, shipping_city, shipping_zip_code)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packets', function (Blueprint $table) {
            $table->dropIndex('fulltext_i_delivery');
            $table->dropIndex('fulltext_i_shipping');
        });
    }
};
