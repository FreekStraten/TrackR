<?php

namespace App\Http\Controllers;

use App\Models\DeliveryDriver;
use App\Models\Pickup;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        // if the user is reciever
        $user = auth()->user();
        if ($user->isReciever()) {
            return redirect()->route('recievers.index');
        }
        // if admin
        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.index');
        }

        if ($user->isUser()) {
            return redirect()->route('user-packets-list');
        }





    }
}
