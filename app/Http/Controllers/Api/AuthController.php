<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Models\AccessTokens;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function register(UsersRequest $request)
    {
        $user = Users::create($request->validated());

        $res = Users::generateAccessToken($user);

        return response()->json(['token' => $res], 201);
    }

    public function login(Request $request)
    {
        $user = Users::where('email', $request->email)
            ->where('password', hash('sha256', $request->password))
            ->first();

        if (is_null($user)) {
            return response()->json(['message' => 'email ou senha incorretos']);
        }

        $res = Users::generateAccessToken($user);

        return response()->json(['token' => $res]);
    }

    public function logout(Request $request)
    {
        $token =  $request->bearerToken();

        $userId = AccessTokens::where('token', $token)->first()->id_user;
        AccessTokens::where('id_user', $userId)->delete();

        return response(null, 204);
    }
}
