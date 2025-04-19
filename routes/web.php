<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RFIDController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\MqttController;
use App\Http\Controllers\DashboardController;
use App\Events\MessageEvent;

// Redirect to login page
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/test', function () {
    return response()->json(['message' => 'Hello from API!']);
});

Route::get('getData',[MqttController::class,'MqttSubscribe']);

// Route::get('/broadcast', function () {
//    $message = '{"tag_id": "2", "location": "Room E"}';
//     // $message = json_encode(['tag_id' => 2, 'location' => 'Room E']);
//     //  $message = [
//     //     'tag_id' => '123456',
//     //     'location' => 'Room A',
//     // ];
//     broadcast(new MessageEvent($message));
//     return view('broadcast');
// });

// Dashboard (requires authentication)

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Middleware group for authenticated users
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // RFID routes
    Route::get('/rfids', [RFIDController::class, 'index'])->name('rfids.index');
    Route::get('/rfids/create', [RFIDController::class, 'create'])->name('rfids.create');
    Route::post('/rfids', [RFIDController::class, 'store'])->name('rfids.store');
    Route::get('/rfids/{rfid}/edit', [RFIDController::class, 'edit'])->name('rfids.edit');
    Route::put('/rfids/{rfid}', [RFIDController::class, 'update'])->name('rfids.update');
    Route::delete('/rfids/{rfid}', [RFIDController::class, 'destroy'])->name('rfids.destroy');
    Route::get('/dashboard/details/{tag_id}', [DashboardController::class, 'showByTagId'])->name('dashboard.details');

});

require __DIR__.'/auth.php';
