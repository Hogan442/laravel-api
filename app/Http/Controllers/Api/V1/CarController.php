<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\V1\CarCollection;
use App\Http\Resources\V1\CarResource;
use App\Http\Resources\V1\DriverCarResource;
use App\Models\Car;
use App\Models\Driver;
use App\Http\Controllers\Controller;
use App\Models\DriverCars;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new CarCollection(Car::all());
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
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        $data = $request->all();
        $message = 'Vehicle was created!';

        $car = Car::create($data);
        $drivers_car = new DriverCars($data);
        $drivers_car->car_id = $car->id;
        $drivers_car->save();
    
        return response()->success($data, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
        $data = new CarResource($car);


        return response()->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    public function updateCarDetails(UpdateCarRequest $request, $id) {

        $car = Car::find($id);
        $car->update($request->all());

        $drivers_car = DriverCars::with('car')->where('car_id', '=', $id);
        $drivers_car->update($request->all());

    


    }

    public function driversVehicle($id) {
        
        return (DriverCarResource::collection(DriverCars::all()->where('car_id', '=', $id)));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
