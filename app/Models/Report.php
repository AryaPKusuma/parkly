<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report';

    protected $fillable = [
        'description',
        'image',
        'parkinglot_id',
    ];

    public function parkingLot()
    {
    return $this->belongsTo(ParkingLots::class, 'parkinglot_id');
    }
}
