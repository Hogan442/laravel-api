<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'home_address',
        'first_name',
        'last_name',
        'license_type',
        'last_trip'
    ];

    public function driver() {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
