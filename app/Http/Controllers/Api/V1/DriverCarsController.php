<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storedriver_carsRequest;
use App\Http\Requests\Updatedriver_carsRequest;
use App\Models\DriverCars;
use App\Models\driver_cars;

class DriverCarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storedriver_carsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storedriver_carsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DriverCars  $driver_cars
     * @return \Illuminate\Http\Response
     */
    public function show(DriverCars $driver_cars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DriverCars  $driver_cars
     * @return \Illuminate\Http\Response
     */
    public function edit(DriverCars $driver_cars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatedriver_carsRequest  $request
     * @param  \App\Models\DriverCars  $driver_cars
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedriver_carsRequest $request, DriverCars $driver_cars)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DriverCars  $driver_cars
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriverCars $driver_cars)
    {
        //
        
    }

    public function deleteCarDetails($id)
    {
        //
        $vehicle_details = DriverCars::destroy($id);
    }
}
