<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\PDF;

class PacketController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Get the authenticated user

        $packets = $user->packets; // Get all packets associated with the user

        // Return the view with the packetList
        return view('packetList', [
            'packets' => $packets,
        ]);
    }

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
            'tracking_number' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
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



    public function uploadCsv(Request $request)
    {
        $file = $request->file('csv_file');

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

    public function packetLabel($id)
    {
        $packet = Packet::find($id);
        return view('packetLabel', compact('packet'));
    }

    //create a pdf packet label for the packet use dompdf
    public function createLabel($id)
    {
        $packet = Packet::find($id);
        $pdf = app('dompdf.wrapper')->loadView('packetLabel', compact('packet'));
        return $pdf->download('packetLabel.pdf');
    }



}
