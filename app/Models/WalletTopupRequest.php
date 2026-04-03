<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTopupRequest extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'utr_number',
        'proof_image',
        'status',
        'admin_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
