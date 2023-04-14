<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class Packets extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('packets')->insert([
            [
                'date' => Carbon::create(2023, 5, 20)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'parcel',
                'weight' => 81,
                'shipping_street' => 'Nieuwezijds Voorburgwal',
                'shipping_house_number' => 6,
                'shipping_city' => 'Amsterdam',
                'shipping_zip_code' => '1234AB',
                'delivery_street' => 'Singel',
                'delivery_house_number' => 452,
                'delivery_city' => 'Utrecht',
                'delivery_zip_code' => '5678CD',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 1, 1)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'letter',
                'weight' => 5,
                'shipping_street' => 'Kruisplein',
                'shipping_house_number' => 12,
                'shipping_city' => 'Rotterdam',
                'shipping_zip_code' => '9012EF',
                'delivery_street' => 'Prinsegracht',
                'delivery_house_number' => 63,
                'delivery_city' => 'Den Haag',
                'delivery_zip_code' => '3456GH',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 2, 14)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'parcel',
                'weight' => 2,
                'shipping_street' => 'Grote Marktstraat',
                'shipping_house_number' => 41,
                'shipping_city' => 'Groningen',
                'shipping_zip_code' => '7890IJ',
                'delivery_street' => 'Sint Pieterstraat',
                'delivery_house_number' => 69,
                'delivery_city' => 'Maastricht',
                'delivery_zip_code' => '1234KL',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 3, 17)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'letter',
                'weight' => 7,
                'shipping_street' => 'Koornmarkt',
                'shipping_house_number' => 92,
                'shipping_city' => 'Leiden',
                'shipping_zip_code' => '5678MN',
                'delivery_street' => 'Hertogstraat',
                'delivery_house_number' => 12,
                'delivery_city' => 'Nijmegen',
                'delivery_zip_code' => '9012OP',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 4, 1)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'parcel',
                'weight' => 13,
                'shipping_street' => 'Keizersgracht',
                'shipping_house_number' => 112,
                'shipping_city' => 'Amsterdam',
                'shipping_zip_code' => '1015 CW',
                'delivery_street' => 'Lange Poten',
                'delivery_house_number' => 27,
                'delivery_city' => 'Den Haag',
                'delivery_zip_code' => '2511 CM',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 5, 5)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'letter',
                'weight' => 3,
                'shipping_street' => 'Oudegracht',
                'shipping_house_number' => 22,
                'shipping_city' => 'Utrecht',
                'shipping_zip_code' => '3511 AM',
                'delivery_street' => 'Keistraat',
                'delivery_house_number' => 7,
                'delivery_city' => 'Amersfoort',
                'delivery_zip_code' => '3811 LA',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 6, 9)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'parcel',
                'weight' => 30,
                'shipping_street' => 'Korte Leidsedwarsstraat',
                'shipping_house_number' => 47,
                'shipping_city' => 'Amsterdam',
                'shipping_zip_code' => '1017 PW',
                'delivery_street' => 'Kapelstraat',
                'delivery_house_number' => 18,
                'delivery_city' => 'Eindhoven',
                'delivery_zip_code' => '5611 KL',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 6, 21)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'letter',
                'weight' => 10,
                'shipping_street' => 'Oude Markt',
                'shipping_house_number' => 7,
                'shipping_city' => 'Enschede',
                'shipping_zip_code' => '7511 GA',
                'delivery_street' => 'Vrijstraat',
                'delivery_house_number' => 32,
                'delivery_city' => 'Eindhoven',
                'delivery_zip_code' => '5611 AZ',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 7, 4)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'parcel',
                'weight' => 10,
                'shipping_street' => 'Oude Markt',
                'shipping_house_number' => 3,
                'shipping_city' => 'Enschede',
                'shipping_zip_code' => '2345PQ',
                'delivery_street' => 'Stationsstraat',
                'delivery_house_number' => 14,
                'delivery_city' => 'Amersfoort',
                'delivery_zip_code' => '6789RS',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 8, 12)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'letter',
                'weight' => 3,
                'shipping_street' => 'Koekoekstraat',
                'shipping_house_number' => 21,
                'shipping_city' => 'Eindhoven',
                'shipping_zip_code' => '3456TU',
                'delivery_street' => 'Oudegracht',
                'delivery_house_number' => 187,
                'delivery_city' => 'Utrecht',
                'delivery_zip_code' => '9012VW',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 10, 31)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'parcel',
                'weight' => 15,
                'shipping_street' => 'Keizersgracht',
                'shipping_house_number' => 301,
                'shipping_city' => 'Amsterdam',
                'shipping_zip_code' => '1234XY',
                'delivery_street' => 'Bilderdijkstraat',
                'delivery_house_number' => 62,
                'delivery_city' => 'Haarlem',
                'delivery_zip_code' => '5678ZA',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 12, 24)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'letter',
                'weight' => 1,
                'shipping_street' => 'Willemsplein',
                'shipping_house_number' => 8,
                'shipping_city' => 'Arnhem',
                'shipping_zip_code' => '9012BC',
                'delivery_street' => 'Lange Bisschopstraat',
                'delivery_house_number' => 19,
                'delivery_city' => 'Deventer',
                'delivery_zip_code' => '3456DE',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 12, 31)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'parcel',
                'weight' => 10,
                'shipping_street' => 'Keizersgracht',
                'shipping_house_number' => 555,
                'shipping_city' => 'Amsterdam',
                'shipping_zip_code' => '1017DR',
                'delivery_street' => 'Korte Houtstraat',
                'delivery_house_number' => 8,
                'delivery_city' => 'Den Haag',
                'delivery_zip_code' => '2511CD',
                'user_id' => 2
            ],
            [
                'date' => Carbon::create(2023, 10, 31)->format('Y-m-d'),
                'tracking_number' => Uuid::uuid4()->toString(),
                'format' => 'letter',
                'weight' => 3,
                'shipping_street' => 'Graanmarkt',
                'shipping_house_number' => 22,
                'shipping_city' => 'Antwerpen',
                'shipping_zip_code' => '2000AB',
                'delivery_street' => 'Rue Neuve',
                'delivery_house_number' => 124,
                'delivery_city' => 'Brussel',
                'delivery_zip_code' => '1000CD',
                'user_id' => 2
            ]
        ]);
    }
}
