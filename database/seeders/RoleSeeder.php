<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // make two roles, one for admin and one for user
        $roles = [
            [
                'name' => 'Super-admin',
            ],
            [
                'name' => 'User',
            ],
        ];

        // insert the roles into the database
        foreach ($roles as $role) {
            DB::table('user_roles')->insert($role);
        }


    }
}
