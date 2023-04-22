<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // make two users, one with the admin role and one with the user role
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.nl',
            'password' => hash::make('admin'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_role' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Normal user',
            'email' => 'normal@user.com',
            'password' => hash::make('user'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_role' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'CasUser',
            'email' => 'CasUser@gmail.com',
            'password' => hash::make('Cas'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_role' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'CasAdmin',
            'email' => 'CasAdmin@gmail.com',
            'password' => hash::make('Cas'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_role' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'FreekUser',
            'email' => 'FreekUser@gmail.com',
            'password' => hash::make('Freek'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_role' => 2,
            'api_key' => 'api_key_1'
        ]);

        DB::table('users')->insert([
            'name' => 'FreekAdmin',
            'email' => 'FreekAdmin@gmail.com',
            'password' => hash::make('Freek'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_role' => 1,
            'api_key' => 'api_key_2'
        ]);

        // reciever acount
        DB::table('users')->insert([
            'name' => 'reci',
            'email' => 'reciever@gmail.com',
            'password' => hash::make('reciever'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_role' => 5,
        ]);


    }
}
