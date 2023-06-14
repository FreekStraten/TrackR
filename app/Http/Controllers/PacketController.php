<?php

namespace App\Http\Controllers;

use App\Models\DeliveryDriver;
use App\Models\PackageStatus;
use App\Models\Packet;
use App\Models\Pickup;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades;

class PacketController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();

        // if the user is reciever
        if ($user->isReciever()) {
            return redirect()->route('recievers.index');
        }

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

    public function changeStatus(Request $request)
    {
        $user = auth()->user();

        $tracking_number = $request->input('tracking_number');
        $status = $request->input('status');

        //check if packet exists in database
        $packet = Packet::where('tracking_number', $tracking_number)->first();
        if (!$packet) {
            //return json response
            return response()->json([
                'success' => false,
                'message' => 'Packet not found',
            ], 400);
        }

        // check if package_status  name exists in database table package_status->name
        $packageStatus = PackageStatus::where('name', $status)->first();
        if (!$packageStatus) {
            //return json response
            return response()->json([
                'success' => false,
                'message' => 'Package status not found',
            ], 400);
        }

        //get id of packagestatus based on name
        $packageStatusId = PackageStatus::where('name', $status)->first()->id;


        //change the packet status
        $packet->package_status_id = $packageStatusId;

        //save
        $packet->save();


        //return json succes with message including packet and package status
        return response()->json([
            'success' => true,
            'message' => 'Packet status changed',
            'packet' => $packet,
            'package_status' => $status,
        ], 200);

    }


    public function store(Request $request)
    {
        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        //if user has role
        Facades\Log::info('test');
        Facades\Log::info('Authenticated User: '.$user);
        Facades\Log::info('CSRF Token: '.$token);

        $packetData = [
            'date' => $request->input('date'),
            'tracking_number' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'format' => $request->input('format'),
            'weight' => $request->input('weight'),
            'shipping_street' => $request->input('shipping_streetname'),
            'shipping_house_number' => $request->input('shipping_housenumber'),
            'shipping_city' => $request->input('shipping_city'),
            'shipping_zip_code' => $request->input('shipping_zipcode'),
            'delivery_street' => $request->input('delivery_streetname'),
            'delivery_house_number' => $request->input('delivery_housenumber'),
            'delivery_city' => $request->input('delivery_city'),
            'delivery_zip_code' => $request->input('delivery_zipcode'),
        ];

        $packet = new Packet($packetData);
        $packet->creator_id = $user->id;
        $packet->save();

        //if request is json then return json response
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Packet created successfully.', 'packet' => $packet], 201);
        }

        return $this->index($request);
    }


    function uploadCsv(Request $request)
    {
        $file = $request->file('csv_file');
        $loggedInUserId = Auth::id();

        if (($handle = fopen($request->file('csv_file')->getPathname(), 'r')) !== false) {

            //ignore the first row
            fgetcsv($handle, 1000, ',');

            // loop through the CSV rows
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                $packet = new Packet();
                $packet->date = $data[0];
                $packet->tracking_number = \Ramsey\Uuid\Uuid::uuid4()->toString();
                $packet->format = $data[1];
                $packet->weight = $data[2];
                $packet->shipping_street = $data[3];
                $packet->shipping_house_number = $data[4];
                $packet->shipping_city = $data[5];
                $packet->shipping_zip_code = $data[6];
                $packet->delivery_street = $data[7];
                $packet->delivery_house_number = $data[8];
                $packet->delivery_city = $data[9];
                $packet->delivery_zip_code = $data[10];
                $packet->user_id = $loggedInUserId;

                $packet->save();
            }

            fclose($handle);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }

    //add delivery driver to the database
    public
    function saveDriver()
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

        public
        function createLabels()
        {
            $user = auth()->user(); // Get the authenticated user
            $packets = $user->packets; // Get all packets associated with the user

            //add qr code to the packets
            foreach ($packets as $packet) {
                $qrCode = QrCode::size(250)->generate($packet->tracking_number);
                $packet->qrCode = $qrCode;
            }

            $pdf = app('dompdf.wrapper')->loadView('packetLabels', compact('packets'));
            return $pdf->download('packetLabel.pdf');
        }

    //create a pdf packet label for the packet use dompdf
    public
    function createLabel($id)
    {
        $packet = Packet::find($id);

        //add qr code to the packet
        $qrCode = QrCode::size(250)->generate($packet->tracking_number);
        $packet->qrCode = $qrCode;

        $pdf = app('dompdf.wrapper')->loadView('packetLabel', compact('packet'));
        return $pdf->download('packetLabel.pdf');
    }


    ///////******** THE FOLLOWING METHODS ARE JUST FOR TESTING ********//////

    //METHOD JUST FOR TESTING
    public
    function showQR($id)
    {
        $packet = Packet::find($id);

        $qrCode = QrCode::size(250)->generate($packet->tracking_number);
        $packet->qrCode = $qrCode;

        return view('QRcode', compact('packet'));
    }

    //METHOD JUST FOR TESTING
    public
    function packetLabels()
    {
        $user = auth()->user(); // Get the authenticated user
        $packets = $user->packets; // Get all packets associated with the user

        //add qr code for each packet
        foreach ($packets as $packet) {
            $qrCode = QrCode::size(250)->generate($packet->tracking_number);
            //make the qr code a png image
            $packet->qrCode = $qrCode;
        }

        return view('packetLabels', compact('packets'));
    }

    //METHOD JUST FOR TESTING
    public
    function packetLabel($id)
    {
        $packet = Packet::find($id);

        //add qr code for a packet
        $qrCode = QrCode::size(250)->format('png')->generate($packet->tracking_number);
        $packet->qrCode = $qrCode;

        return view('packetLabel', compact('packet'));
    }
}
