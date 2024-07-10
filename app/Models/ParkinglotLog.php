<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkinglotLog extends Model
{
    use HasFactory;

    protected $table = 'parkinglots_log';

    protected $fillable = [
        'parkinglot_id',
        'user_id',
        'amount',
        'parking_date',
    ];


    public function parkinglot()
    {
        return $this->belongsTo(ParkingLots::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
