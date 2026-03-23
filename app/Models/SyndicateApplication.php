<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyndicateApplication extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'sector', 'status', 'message'];
}
