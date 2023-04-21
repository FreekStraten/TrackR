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
        Schema::create('package_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

           // alter the packets table, give the id a default value of 1
        Schema::table('packets', function (Blueprint $table) {
            $table->foreignId('package_status_id')->default(1)
                ->constrained('package_status');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // check if the key exists first
        if (Schema::hasColumn('packets', 'package_status_id')) {
            Schema::table('packets', function (Blueprint $table) {
                $table->dropForeign(['package_status_id']);
                $table->dropColumn('package_status_id');
            });
        }

        Schema::dropIfExists('package_status');
    }
};
