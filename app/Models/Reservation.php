<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'reservations';
    protected $primaryKey = 'idreservation';
    protected $fillable = [
        'police_number',
        'vehicle_type',
        'vehicle_brand',
        'user_id',
        'parkinglots_id',
        'parking_number',
        'parking_name',
        'status',
    ];

    // Definisi relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Definisi relasi dengan model ParkingLot
    public function parkingLot()
    {
        return $this->belongsTo(ParkingLots::class, 'parkinglots_id');
    }


}
