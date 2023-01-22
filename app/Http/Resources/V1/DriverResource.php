<?php

namespace App\Http\Resources\V1;

use App\Http\Controllers\Api\V1\DetailController;
use App\Models\Car;
use App\Models\Detail;
use App\Models\DriverCars;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
{

    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_number' => $this->id_number,
            'phone_number' => $this->phone_number,
            'details' => DetailResource::collection(Detail::all()->where('driver_id', '=', $this->id))->first(),
            'vehicle' => DriverCarResource::collection(DriverCars::all()->where('driver_id', $this->id))
        ];
    }
    
}
