<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;
    protected $table = 'user_histories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'action',
        'parkinglots_id',
    ];
    public function parkingLot()
    {
        return $this->belongsTo(ParkingLots::class, 'parkinglots_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
