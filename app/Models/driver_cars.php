<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver_cars extends Model
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
        return $this->hasMany(Driver::class);
    }

    public function cars() {
        return $this->hasMany(Car::class);
    }
}
