<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ParkingLots;
use App\Models\User;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = ['user_id', 'parkinglot_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parkingLot()
    {
        return $this->belongsTo(ParkingLots::class, 'parkinglot_id');
    }
}
