<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'place',
        'date',
        'pay',
        'status',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(App\Models\User::class);
    }
}
