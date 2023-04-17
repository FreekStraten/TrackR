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
    public function index($planned = false)
    {
        // Get all packets that have not had a pick up planned yet
        // if planned is true, only get ones that have been planned
        if ($planned) {
            $packetswithoutpickups = Packet::whereNotNull('pick_up_id')->get();
        } else {
            $packetswithoutpickups = Packet::whereNull('pick_up_id')->get();
        }


        return view('pickups.index', ['packets' => $packetswithoutpickups], ['planned' => $planned]);
    }

    public function planned()
    {
        $packetswithoutpickups = Pickup::get();

        return view('pickups.plannedpickups', ['packets' => $packetswithoutpickups], ['planned' => true]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        // Get the packet with the given id
        $packet = Packet::find($id);
        return view('pickups.create', ['packet' => $packet]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // valdidate the pickup data, Everything is required, Date should be before today and time before 15:00
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
            'package_id' => $request->packet_id,
        ]);



        $pickup->save();

        // Get the packet with the given id
        $packet = Packet::find($request->packet_id);

        // Set the pickup id of the packet to the id of the pickup
        $packet->pick_up_id = $pickup->id;
        $packet->save();

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
