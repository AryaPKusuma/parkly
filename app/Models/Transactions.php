<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'amount',
        // 'transaction_type',
        'transaction_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
