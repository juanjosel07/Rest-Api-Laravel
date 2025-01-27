<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
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

Route::group(['prefix' => 'hotels', 'controller' => HotelController::class], function () {
    Route::get('/', 'index');
    Route::get('/{hotel}', 'getHotelById');
    Route::post('/', 'store');
    Route::put('/{hotel}', 'update');
    Route::delete('/{hotel}', 'destroy');
    // Route::get('/{id}', 'show');
    // Route::put('/{id}', 'update');
    // Route::delete('/{id}', 'destroy');
});

Route::group(['prefix' => 'hotels/{hotel}/rooms', 'controller' => RoomController::class], function () {
    Route::get('/', 'index');
    Route::get('/{roomType}', 'getRoomById');
    Route::post('/', 'store');
    Route::put('/{assignmentId}', 'update');
    Route::delete('/{assignmentId}', 'destroy');
});

Route::get('/rooms/types', [RoomTypeController::class, 'index']);
