<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add the following status Aangemeld, Uitgeprint, Afgeleverd, Sorteercentrum, onderweg, afgeleverd
        $status = [
            [
                'name' => 'CheckedIn',
                'id' => 1,
            ],
            [
                'name' => 'Printed',
                'id' => 2,
            ],
            [
                'name' => 'DeliveredAtDeliveryPoint',
                'id' => 3,
            ],
            [
                'name' => 'SorterCenter',
                'id' => 4,
            ],
            [
                'name' => 'OnRouteToFinalDestination',
                'id' => 5,
            ],
            [
                'name' => 'DeliveredAtFinalDestination',
                'id' => 6,
            ],


        ];

        // add the status's to the database
        foreach ($status as $stat) {
               DB::table('package_status')->insert($stat);

        }



    }
}
