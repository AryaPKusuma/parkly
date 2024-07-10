<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable = [
        'user_id',
        'rating',
        'comment',
        'parkinglot_id',
    ];

    public function parkinglot()
    {
        return $this->belongsTo(ParkingLot::class, 'parkinglot_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
