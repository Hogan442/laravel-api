<?php

use App\Http\Controllers\Api\V1\DetailController;
use App\Http\Controllers\Api\V1\DriverController;
use App\Http\Controllers\Api\V1\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('drivers', DriverController::class);
    Route::apiResource('details', DetailController::class);
    Route::apiResource('cars', CarController::class);

    Route::get('drivers/{id}/vehicles', 'App\Http\Controllers\Api\V1\CarController@driversVehicle');
    
});
 