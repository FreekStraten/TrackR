<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Request;
use App\Http\Controllers\Controller;
use App\Models\Packet;
use Illuminate\Http\Request;


class PacketController extends Controller
{
    //index
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'tracking_number' => 'required|string',
            'format' => 'required|in:letter,parcel',
            'weight' => 'required|integer',
            'shipping_street' => 'required|string',
            'shipping_house_number' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_zip_code' => 'required|string',
            'delivery_street' => 'required|string',
            'delivery_house_number' => 'required|string',
            'delivery_city' => 'required|string',
            'delivery_zip_code' => 'required|string',
        ]);

        $packet = new Packet([
            'date' => $validatedData['date'],
            'tracking_number' => $validatedData['tracking_number'],
            'format' => $validatedData['format'],
            'weight' => $validatedData['weight'],
            'shipping_street' => $validatedData['shipping_street'],
            'shipping_house_number' => $validatedData['shipping_house_number'],
            'shipping_city' => $validatedData['shipping_city'],
            'shipping_zip_code' => $validatedData['shipping_zip_code'],
            'delivery_street' => $validatedData['delivery_street'],
            'delivery_house_number' => $validatedData['delivery_house_number'],
            'delivery_city' => $validatedData['delivery_city'],
            'delivery_zip_code' => $validatedData['delivery_zip_code'],
        ]);

        $packet->save();

        return response()->json([
            'message' => 'Packet created successfully',
            'data' => $packet,
        ], 201);
    }
}
