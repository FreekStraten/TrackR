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
            // date and time of pick up, address of pick up and the package to be picked up (foreign key)
            $table->dateTime('pick_up_date_time');
            $table->string('pickup_street');
            $table->string('pickup_house_number');
            $table->string('pickup_city');
            $table->string('pickup_zip_code');
            $table->foreignId('package_id')->constrained('packets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pick_ups');
    }
};
