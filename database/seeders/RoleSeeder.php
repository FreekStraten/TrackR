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
                'name' => 'Super-admin', // Is a role with read and write access to everything
                'id' => 1,
            ],
            [
                'name' => 'User', // normal customer
                'id' => 2,
            ],
            [
                'name' => 'Administator', // Is a role with read and write access to the packages
                'id' => 3,
            ],
            [
                'name' => 'PackagePacker', // Is a role with only read access to the packages
                'id' => 4,
            ]
        ];

        // insert the roles into the database
        foreach ($roles as $role) {
            DB::table('user_roles')->insert($role);
        }


    }
}
