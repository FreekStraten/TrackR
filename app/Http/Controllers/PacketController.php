<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Request;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PacketController extends Controller
{
    //index
    public function store(Request $request)
    {
        $packet = new Packet([
            'date' => $request['date'],
            'tracking_number' => $request['tracking_number'],
            'format' => $request['format'],
            'weight' => $request['weight'],
            'shipping_street' => $request['shipping_streetname'],
            'shipping_house_number' => $request['shipping_housenumber'],
            'shipping_city' => $request['shipping_city'],
            'shipping_zip_code' => $request['shipping_zipcode'],
            'delivery_street' => $request['delivery_streetname'],
            'delivery_house_number' => $request['delivery_housenumber'],
            'delivery_city' => $request['delivery_city'],
            'delivery_zip_code' => $request['delivery_zipcode'],
        ]);

        $packet->save();

        return redirect()->route('create-package')->with('success', 'Packet created successfully.');
    }



    public function uploadCsv(Request $request)
    {

        $file = $request->file('csv_file');




        //data dump all the text inside the file
//        $file = fopen($file, "r");
//        while(! feof($file))
//        {
//            print_r(fgetcsv($file));
//        }
//        fclose($file);





        if (($handle = fopen($request->file('csv_file')->getPathname(), 'r')) !== false) {

            //ignore the first row
            fgetcsv($handle, 1000, ',');

            // loop through the CSV rows
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                $packet = new Packet();
                $packet->date = $data[0];
                $packet->tracking_number = $data[1];
                $packet->format = $data[2];
                $packet->weight = $data[3];
                $packet->shipping_street = $data[4];
                $packet->shipping_house_number = $data[5];
                $packet->shipping_city = $data[6];
                $packet->shipping_zip_code = $data[7];
                $packet->delivery_street = $data[8];
                $packet->delivery_house_number = $data[9];
                $packet->delivery_city = $data[10];
                $packet->delivery_zip_code = $data[11];

                $packet->save();
            }

            fclose($handle);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }



}
