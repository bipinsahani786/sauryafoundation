<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharityDonation extends Model
{
    protected $fillable = [
        'donation_id',
        'name',
        'email',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
        'receipt_path',
    ];
}
