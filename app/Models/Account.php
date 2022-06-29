<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    // Add a global scope to query only those accounts
    // whose status is ACTIVE.
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('active', function ($query) {
            $query->where('status', 'ACTIVE');
        });
    }

    // Add a relationship to the Metric model.
    public function metrics()
    {
        return $this->hasMany(Metric::class, 'accountId', 'accountId');
    }

    public function scopeAccount($query,$accountId)
    {
        return $query->where('accountId',$accountId);
    }

}
