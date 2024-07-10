<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';

    protected $fillable = [
        'user_id',
        'amount',
        'purchase_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
