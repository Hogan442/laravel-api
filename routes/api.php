<?php

use App\Http\Controllers\Api\V1\DetailController;
use App\Http\Controllers\Api\V1\DriverController;
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


Route::group([], function () {
    Route::apiResource('details', DetailController::class);
    Route::apiResource('drivers', DriverController::class);
    Route::post('vehicle', 'App\Http\Controllers\Api\V1\CarController@store');

});

Route::group(['prefix' => 'drivers'], function () {
    Route::get('{id}/vehicles', 'App\Http\Controllers\Api\V1\CarController@driversVehicle');
    Route::patch('{id}/details', 'App\Http\Controllers\Api\V1\DetailController@updateDriversDetails');
    Route::delete('{id}/details', 'App\Http\Controllers\Api\V1\DetailController@deleteDriversDetails');
    
});

Route::group(['prefix' => 'vehicles'], function () {
    Route::delete('{id}', 'App\Http\Controllers\Api\V1\DriverCarsController@deleteCarDetails');
});

