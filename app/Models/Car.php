<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_make',
        'vehicle_model',
        'model_year',
        'passenger_capacity'
    ];

    public function driver_cars() {
        return $this->belongsToMany(driver_cars::class, 'driver_cars');
    }
}
