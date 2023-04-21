<?php

namespace App\Http\Controllers;

use App\Models\DeliveryDriver;
use App\Models\Packet;
use App\Models\Pickup;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class PacketController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();



        $format = $request->input('format');
        $sortByDate = $request->input('sortByDate');
        $sortDirection = $request->input('sortDirection');
        $page = $request->input('page', 1);


        $searchTerm = $request->input('search');

        $query = $user->packets();

        //search the packets by the search term using Full Text Search on the key name is fulltext_i_delivery
        if (!empty($searchTerm)) {
            $fixedSearchTerm = $searchTerm . '*';
            $query = $query->whereRaw("(MATCH(delivery_street, delivery_house_number, delivery_city, delivery_zip_code) AGAINST(? IN BOOLEAN MODE)
                                OR MATCH(shipping_street, shipping_house_number, shipping_city, shipping_zip_code) AGAINST(? IN BOOLEAN MODE))", [$fixedSearchTerm, $fixedSearchTerm]);
        }

        $pickupspecification = $request->input('pickup_id');
        if (!empty($pickupspecification)) {
            $query = $query->where('pick_up_id', $pickupspecification);
        }


        if (!empty($format)) {
            $query = $query->where('format', $format);
        }

        if (!empty($sortByDate)) {
            $query = $query->orderBy('date', $sortByDate);
        }

        if (!empty($sortDirection)) {
            $query = $query->orderBy('weight', $sortDirection);
        }

        $packets = $query->paginate(10, ['*'], 'page', $page);

        $packets->appends([
            'format' => $format,
            'sortByDate' => $sortByDate,
            'sortDirection' => $sortDirection,
            'search' => $searchTerm,
        ]);

        $delivery_drivers = DeliveryDriver::all();

        // for each packet in the list, get the pickup if it exists
        foreach ($packets as $packet) {
            if ($packet->pick_up_id) {
                // get the pickup
                $packet->pickup = Pickup::find($packet->pick_up_id);
            }
        }

        return view('packetList', [
            'delivery_drivers' => $delivery_drivers,
            'packets' => $packets,
            'selectedFormat' => $format,
            'sortByDate' => $sortByDate,
            'sortDirection' => $sortDirection,
            'searchTerm' => $searchTerm,
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

    //METHOD JUST FOR TESTING
    public function packetLabel($id)
    {
        $packet = Packet::find($id);
        return view('packetLabel', compact('packet'));
    }

    //create a pdf packet label for all packets of the user
    //METHOD JUST FOR TESTING
    public function packetLabels()
    {
        $user = auth()->user(); // Get the authenticated user
        $packets = $user->packets; // Get all packets associated with the user
        return view('packetLabels', compact('packets'));
    }

    public function createLabels()
    {
        $user = auth()->user(); // Get the authenticated user
        $packets = $user->packets; // Get all packets associated with the user
        $pdf = app('dompdf.wrapper')->loadView('packetLabels', compact('packets'));
        return $pdf->download('packetLabel.pdf');
    }


    //create a pdf packet label for the packet use dompdf
    public function createLabel($id)
    {
        $packet = Packet::find($id);
        $pdf = app('dompdf.wrapper')->loadView('packetLabel', compact('packet'));
        return $pdf->download('packetLabel.pdf');
    }

    //add delivery driver to the database
    public function saveDriver()
    {
        $id = request('id');
        $deliveryDriver = request('delivery_driver');
        $packet = Packet::find($id);

        $driverExists = DeliveryDriver::where('name', $deliveryDriver)->exists();

        if ($driverExists) {
            $packet->delivery_driver = $deliveryDriver;
        } else {
            $packet->delivery_driver = null;
        }

        $packet->save();
        return redirect()->back()->with('success', 'Delivery driver added successfully.');
    }


}
