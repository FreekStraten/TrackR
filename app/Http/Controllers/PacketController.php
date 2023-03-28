<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PacketController extends BaseController
{
    //index
    public function index()
    {
        return view('packetCreate');
    }

    //create
    public function create()
    {
        return view('Packets.create');
    }

    //store
    public function store()
    {
        return view('Packets.store');
    }
}
