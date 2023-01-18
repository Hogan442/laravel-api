<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storedriver_carsRequest;
use App\Http\Requests\Updatedriver_carsRequest;
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
     * @param  \App\Models\driver_cars  $driver_cars
     * @return \Illuminate\Http\Response
     */
    public function show(driver_cars $driver_cars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\driver_cars  $driver_cars
     * @return \Illuminate\Http\Response
     */
    public function edit(driver_cars $driver_cars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatedriver_carsRequest  $request
     * @param  \App\Models\driver_cars  $driver_cars
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedriver_carsRequest $request, driver_cars $driver_cars)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\driver_cars  $driver_cars
     * @return \Illuminate\Http\Response
     */
    public function destroy(driver_cars $driver_cars)
    {
        //
    }
}
