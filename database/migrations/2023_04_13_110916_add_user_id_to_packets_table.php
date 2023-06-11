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
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict');
        });

        Schema::table('packets', function (Blueprint $table) {
            $table->foreignId('creator_id')

                ->nullable()
                ->constrained('users')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('packets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('packets', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
        });
    }
};
