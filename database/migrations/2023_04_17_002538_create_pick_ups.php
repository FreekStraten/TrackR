<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pick_ups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // date and time of pick up, address of pick up location. one pickup can have many packets
            $table->dateTime('pick_up_date_time');
            $table->string('pickup_street');
            $table->string('pickup_house_number');
            $table->string('pickup_city');
            $table->string('pickup_zip_code');
        });

        // alter the packets table to add the foreign key to the pick up table
        Schema::table('packets', function (Blueprint $table) {
            $table->foreignId('pick_up_id')->nullable()->constrained('pick_ups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('packets', 'pick_up_id')) {
            Schema::table('packets', function (Blueprint $table) {
                $table->dropForeign(['pick_up_id']);
                $table->dropColumn('pick_up_id');
            });
        }
        Schema::dropIfExists('pick_ups');







    }
};
