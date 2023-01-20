<?php

namespace App\Http\Resources\V1;

use App\Models\Car;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverCarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $vehicle = CarResource::collection(Car::all()->where('id', '=', $this->car_id))->first();

        return [
            // 'driver_id' => $this->driver_id,
            'id'=>$this->car_id,
            'license_plate' => $this->license_plate,
            'vehicle_make' => $vehicle->vehicle_make,
            'vehicle_model' => $vehicle->vehicle_model,
            'year' => $vehicle->model_year,
            'insured' => $this->insured,
            'last_service' => $this->last_service,
            'capacity' => $vehicle->passenger_capacity
            
        ];
    }
}
