<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [
        'id_type',
        'name',
        'email',
        'password'
    ];

    public $timestamps = false;

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = hash('sha256', $value);
    }

    public static function generateAccessToken(Users $user)
    {
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];
        $header = base64_encode(json_encode($header));

        $payload = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'timestamp' => time()
        ];
        $payload = base64_encode(json_encode($payload));

        $sig = base64_encode(hash_hmac('sha256', "$header.$payload", 'augsburg'));

        $tokenJwt = "$header.$payload.$sig";

        AccessTokens::create([
            'id_user' => $user->id,
            'token' => $tokenJwt,
            'created_at' => date_create()
        ]);

        return $tokenJwt;
    }
}
