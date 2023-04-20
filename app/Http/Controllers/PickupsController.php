<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use App\Models\Pickup;
use Illuminate\Http\Request;

class PickupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pickups = Pickup::get();

        // for each pickup, get the packets that are linked to it
        foreach($pickups as $pickup) {
            $pickup->packets = Packet::where('pick_up_id', $pickup->id)->get();
        }

        return view('pickups.index', ['pickups' => $pickups]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // get all the packets using the id's that are included in the checkbox[] in request

        $pickupsids = explode(',', $request->query('pickupsids'));
        $packets = [];
        foreach($pickupsids  as $id) {
            // if it exists
            if (Packet::find($id)) {
                // add it to the array
                $packets[] = Packet::find($id);
            }
        }

        return view('pickups.create', ['packets' => $packets, 'packetids' => $pickupsids ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // valdidate the pickup data, Everything is required, Date should be after today and time before 15:00
        $request->validate([
            'date' => 'required|date|after:tomorrow',
            'time' => 'required|date_format:H:i|before:15:00',
            'pickup_street' => 'required|string',
            'pickup_house_number' => 'required|string',
            'pickup_city' => 'required|string',
            'pickup_zip_code' => 'required|string',
        ]);

        // Create a new pickup
        $pickup = new Pickup([
            'pick_up_date_time' =>  new \DateTime($request->date . ' ' . $request->time),
            'pickup_street' => $request->pickup_street,
            'pickup_house_number' => $request->pickup_house_number,
            'pickup_city' => $request->pickup_city,
            'pickup_zip_code' => $request->pickup_zip_code,
        ]);


        $pickup->save();


        foreach($request->packetids as $id) {
            // if it exists
            if (Packet::find($id)) {
                // add the pickup id to the packet
                $packet = Packet::find($id);
                $packet->pick_up_id = $pickup->id;
                $packet->save();
            }
        }



        return redirect()->route('pickups.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
