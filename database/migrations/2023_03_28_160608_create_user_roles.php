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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // alter the users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('user_role')
                ->references('id')
                ->on('user_roles')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // alter the users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_role']);
            $table->dropColumn('user_role');
        });
        Schema::dropIfExists('user_roles');


    }
};
