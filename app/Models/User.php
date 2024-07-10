<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ParkingLots;
use App\Models\Favorite;
// use App\Models\Rating;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'notelp',
        'password',
        'deposit',
        'role',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //---------------- Setiap User Bisa Memiliki Banyak Parkiran --------------------
    public function parkir()
    {
        return $this->hasMany(ParkingLots::class, 'user_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // public function deposit()
    // {
    //     return $this->hasOne(Deposit::class);
    // }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    public function countParkingLots()
    {
        return $this->parkingLots()->count();
    }

    public function parkingLots()
    {
        return $this->hasMany(ParkingLots::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
