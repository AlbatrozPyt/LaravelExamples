<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessTokens extends Model
{
    protected  $fillable = [
        'id_user',
        'token',
        'created_at'
    ];

    public $timestamps = false;
}
