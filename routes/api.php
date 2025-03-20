<?php

use App\Http\Controllers\Api\AirportDetailController;
use App\Http\Controllers\Api\FlightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('airport-details')->group(function () {
    Route::get('/', [AirportDetailController::class, 'index']); // List all airports
    Route::get('{id}', [AirportDetailController::class, 'show']); // Show specific airport
    Route::post('/', [AirportDetailController::class, 'store']); // Create new airport
    Route::put('{id}', [AirportDetailController::class, 'update']); // Update specific airport
    Route::delete('{id}', [AirportDetailController::class, 'destroy']); // Delete specific airport
    Route::post('import', [AirportDetailController::class, 'importCSV']); // Import CSV data
});

Route::prefix('flights')->group(function () {
    Route::get('/', [FlightController::class, 'index']);
    Route::get('/{id}', [FlightController::class, 'show']);
    Route::post('/', [FlightController::class, 'store']);
    Route::put('/{id}', [FlightController::class, 'update']);
    Route::delete('/{id}', [FlightController::class, 'destroy']);
});

Route::get('airport/search/{letter}', [AirportDetailController::class, 'searchByIdentFirstLetter']);