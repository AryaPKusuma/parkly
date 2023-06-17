<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLots extends Model
{
    use HasFactory;
    protected $table = 'parkinglots';

    protected $fillable = [
        'parking_name',
        'capacity',
        'address',
        'cost',
    ];
}
