<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//route to PacketController
Route::get('/packets', [App\Http\Controllers\PacketController::class, 'index']);
Route::post('/packets', [App\Http\Controllers\PacketController::class, 'store'])->name('packets.store');
