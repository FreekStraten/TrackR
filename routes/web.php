<?php

use App\Http\Controllers\ProfileController;
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
    return view('homepage');
})->name('homepage');

Route::post('/store-package', [App\Http\Controllers\PacketController::class, 'store'])->name('packet_create.store');

Route::middleware('api')->post('/api/packages', [App\Http\Controllers\PacketController::class, 'store']);

Route::post('/package', [App\Http\Controllers\PacketController::class, 'store'])->name('packet_create.store');

Route::post('/package_csv', [App\Http\Controllers\PacketController::class, 'uploadCsv'])->name('packet_create.uploadCsv');

Route::get('/create-package', function () {
    return view('packetCreate');
})->name('create-package');

Route::get('/packets', [App\Http\Controllers\PacketController::class, 'index'])->middleware('auth')->name('user-packets-list');

Route::get('/packets/{format?}', [App\Http\Controllers\PacketController::class, 'index'])
    ->where('format', '(letter|parcel)?')
    ->name('packets.index');

Route::get('/create-label/{id}', [App\Http\Controllers\PacketController::class, 'createLabel'])->middleware('auth')->name('createLabel');

Route::get('/labels', [App\Http\Controllers\PacketController::class, 'createLabels'])->middleware('auth')->name('createLabels');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/admin/create', [\App\Http\Controllers\AdminController::class, 'create'])->name('admin.create')->middleware('auth');
Route::post('/admin/store', [\App\Http\Controllers\AdminController::class, 'store'])->name('admin.store')->middleware('auth');
Route::post('/admin/destroy', [\App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.destroy')->middleware('auth');


// pickups
Route::get('/pickups', [\App\Http\Controllers\PickupsController::class, 'index'])->name('pickups.index')->middleware('auth');
Route::get('/pickups/planned', [\App\Http\Controllers\PickupsController::class, 'planned'])->name('pickups.planned')->middleware('auth');
Route::get('/pickups/create/{id}', [\App\Http\Controllers\PickupsController::class, 'create'])->name('pickups.create')->middleware('auth');
Route::post('/pickups/store', [\App\Http\Controllers\PickupsController::class, 'store'])->name('pickups.store')->middleware('auth');
Route::get('/pickups/show/{id}', [\App\Http\Controllers\PickupsController::class, 'show'])->name('pickups.show')->middleware('auth');



Route::get('locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');

require __DIR__ . '/auth.php';

Route::get('/packetLabel/{id}', [App\Http\Controllers\PacketController::class, 'packetLabel'])->middleware('auth')->name('packetLabel');

Route::get('/packetLabels', [App\Http\Controllers\PacketController::class, 'packetLabels'])->middleware('auth')->name('packetLabels');

Route::post('/saveDriver', [App\Http\Controllers\PacketController::class, 'saveDriver'])->middleware('auth')->name('saveDriver');
