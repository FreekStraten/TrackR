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
    return view('welcome');
});

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

require __DIR__.'/auth.php';
