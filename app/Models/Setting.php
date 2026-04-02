<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function getAll()
    {
        return self::pluck('value', 'key')->toArray();
    }
}
