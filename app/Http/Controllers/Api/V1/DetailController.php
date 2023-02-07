<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDetailRequest;
use App\Http\Requests\UpdateDetailRequest;
use App\Http\Resources\V1\DetailCollection;
use App\Http\Resources\V1\DetailResource;
use App\Models\Driver;
use App\Models\Detail;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new DetailCollection(Detail::all());
        return response()->success($data);
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
     * @param  \App\Http\Requests\StoreDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetailRequest $request)
    {
        // Store new Drivers Details
        $data = Detail::create($request->all());

       return response()->success($data);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        //
        $data = new DetailResource($detail);
        return response()->success($data);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        //
    }



    /**
     * Uodates the details of one individual driver
     *
     * @param UpdateDetailRequest $request
     * @param mixed $id
     * @return void
     */
    public function updateDriversDetails(UpdateDetailRequest $request, $id) {

        $detail = Detail::with('driver')->where('driver_id', '=', $id);
        $detail->update($request->all());
        return response()->success($request);
    }



    /**
     * Delete the details that belongs to the driver with the id of @param mixed $id
     * @param mixed $id
     * @return mixed
     */
    public function deleteDriversDetails($id) {
        try{
            $driver = Driver::find($id);
            $detail = $driver->detail;
            $detail->delete();
            return response()->success([], 200, 'deleted');
        } catch(\Exception $exception) {
            return response()->error('Driver does not exist');
        }
    }
}
