<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Detail;
use App\Models\Driver;
use App\Http\Resources\V1\DriverResource;
use Illuminate\Http\Response;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::all();
        $data = DriverResource::collection($drivers);
        return response()->success($data);
       
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDriverRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDriverRequest $request)
    {
        $data = $request->all();

        try
        {
            // Create new Driver in the Database
            $message = 'Driver account created!';
            $driver = Driver::create($data);

            // Store Drivers details
            $detail = new Detail($data);
            $detail->driver_id = $driver->id;
            $detail->save();

            return response()->success($data, $message);

        } catch (\Exception $exception) {

            // Error response if driver details was not correct
            $message = 'Driver could not be created.';
            return response()->error($message, $data);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get a specific driver from the database

        try {
            $driver = Driver::all()->where('id', '=', $id)->first();
            $data = new DriverResource($driver);
            return response()->success($data);

        } catch (\Exception $exception) {


            $error_message = "Could not get your driver";
            $data = [];
            return response()->error($error_message, $data);
        }

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDriverRequest  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDriverRequest $request, $id)
    {

        try {
            $driver = Driver::all()->where('id', '=', $id);
            $driver->update($request->all());
            return response()->success($request->all());

        } catch (\Exception $exception){
            $message = 'Could not update the driver';
            return response()->error($message, $request->all());
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param UpdateDriverRequest $request
     * @param $id
     * @return Response
     */
    public function destroy(UpdateDriverRequest $request, $id)
    {
        // Delete the Driver
        $driver = Driver::find($id);

        if($driver==null) {
            $message = 'Could not delete the driver';

            return response()->error($message, $request->all());
        } else {
            $driver->delete();
            return response()->success($request->all());
        }
    
    }
}
