<?php

namespace App\Http\Resources\V1;

use App\Models\DriverCars;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return (DriverCarResource::collection(DriverCars::all()->where('car_id', '=', $this->id)))->first();
        // return [
        //     'id' => $this->id,
        //     'license_plate' => DriverCarResource::collection(DriverCars::all()->where('car_id', '=', $this->id))->first()->license_plate,
        //     'vehicle_make' => $this->vehicle_make,
        //     'vehicle_model' => $this->vehicle_model,
        //     'year' => $this->model_year,
        //     'insured' => DriverCarResource::collection(DriverCars::all()->where('car_id', '=', $this->id))->first()->insured,
        //     'service_date' => DriverCarResource::collection(DriverCars::all()->where('car_id', '=', $this->id))->first()->last_service,
        //     'capacity' => $this->passenger_capacity
        // ];
    }
}
