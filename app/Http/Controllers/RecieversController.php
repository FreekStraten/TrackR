<?php

namespace App\Http\Controllers;

use App\Models\DeliveryDriver;
use App\Models\PackageStatus;
use App\Models\Packet;
use App\Models\Pickup;
use Illuminate\Http\Request;

class RecieversController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if (!$user->isReciever()) {
            return redirect()->route('user-packets-list');
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


        // for every package, get the name of the status
        foreach ($packets as $packet) {
            $packet->status = $packet->packageStatus()->first()->name;
        }

        return view('recievers.packetList', [
            'delivery_drivers' => $delivery_drivers,
            'packets' => $packets,
            'selectedFormat' => $format,
            'sortByDate' => $sortByDate,
            'sortDirection' => $sortDirection,
            'searchTerm' => $searchTerm,
        ]);
    }

    public function history(Request $request)
    {
        $user = auth()->user();
        if (!$user->isReciever()) {
            return redirect()->route('user-packets-list');
        }

        // get every packet that has been delivered to the user
        $packets = Packet::where('package_status_id', PackageStatus::DELIVERED_AT_FINAL_DESTINATION)->get();




        return view('recievers.history', [
            'packets' => $packets,
        ]);
    }

    public function giveFeedback(Request $request)
    {
        $user = auth()->user();
        if (!$user->isReciever()) {
            return redirect()->route('user-packets-list');
        }
        $packetId = $request->input('packet_id');
        $packet = Packet::find($packetId);
        $packet->feedback = $request->input('feedback');
        $packet->save();
        return redirect()->route('user-packets-list');
    }



}
