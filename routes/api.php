<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//create an API for the packets store
Route::middleware('auth:sanctum')->post('/packetAPI', [App\Http\Controllers\PacketController::class, 'store']);


//create an API for the changeStatus
Route::middleware('auth:sanctum')->post('/changeStatus', [App\Http\Controllers\PacketController::class, 'changeStatus']);




