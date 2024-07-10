<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;
use App\Models\Favorite;

class ParkingLots extends Model
{
    use HasFactory;
    protected $table = 'parkinglots';
    protected $primaryKey = 'idparking';

    protected $fillable = [
        'parking_name',
        'capacity',
        'address',
        'cost',
        'photo',
        'user_id',
        'status',
        'jam_buka',
        'jam_tutup',
        'latitude',
        'longitude',
        'profit',
        'lonlat',

    ];

    //-------------Setiap Parkiran Hanya dimiliki oleh satu User------------------
    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'parkinglots_id');
    }

    public function userHistories()
    {
        return $this->hasMany(UserHistory::class, 'idparking');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'parkinglot_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'parkinglot_id');
    }

}
