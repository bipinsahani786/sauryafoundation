<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'title',
        'description',
        'sector',
        'min_investment',
        'target_irr',
        'status',
    ];

    public function subscriptions()
    {
        return $this->hasMany(PlanSubscription::class);
    }
}
