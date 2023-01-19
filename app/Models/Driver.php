<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'phone_number'
    ];


    public function detail() {
        return $this->hasOne(Detail::class);
    }

    public function driver_cars() {
        return $this->belongsToMany(driver_cars::class, 'driver_cars');
    }
}
