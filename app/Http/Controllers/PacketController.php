<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    public function store(Request $request)
    {
        // Check if request has an API key
        if ($request->has('api_key')) {
            $user = \App\Models\User::where('api_key', $request->api_key)->first();

            // Check if user with provided API key exists
            if (!$user) {
                return response()->json(['message' => 'Invalid API key.'], 401);
            }
        } else {
            // If no API key provided, get the authenticated user
            $user = auth()->user();

            // Check if user is authenticated
            if (!$user) {
                return response()->json(['message' => 'Unauthorized.'], 401);
            }
        }

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

        $packet->user()->associate($user); // associate the user with the packet
        $packet->save();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Packet created successfully.',
                'packet' => $packet
            ]);
        } else {
            return view('packetCreate')->with('success', 'Packet created successfully.');
        }
    }
}
