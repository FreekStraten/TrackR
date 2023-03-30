<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Request;
use App\Models\Packet;
use Illuminate\Http\Request;


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
}
