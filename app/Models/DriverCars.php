<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverCars extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'car_id',
        'license_plate',
        'insured',
        'last_service'
    ];

    public function drivers() {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
    public function cars() {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
