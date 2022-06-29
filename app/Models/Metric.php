<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Metric extends Model
{
    use HasFactory;

    // Add inverse relationship to the Account model.
    public function account()
    {
        return $this->belongsTo(Account::class, 'accountId', 'accountId');
    }
}
