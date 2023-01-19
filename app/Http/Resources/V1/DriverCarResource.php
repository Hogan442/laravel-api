<?php

namespace App\Http\Resources\V1;

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
        return [
            'driver_id' => $this->driver_id,
            'car_id'=>$this->car_id,
            'license_plate' => $this->license_plate,
            'insured' => $this->insured,
            'last_service' => $this->last_service
        ];
    }
}
