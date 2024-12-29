<?php

namespace App\Http\Middleware;

use App\Models\AccessTokens;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        $tokenIsValid = AccessTokens::where('token', $token)->first();

        if (is_null($tokenIsValid)) {
            return response()->json(['message' => 'Token inválido'], 401);
        }

        return $next($request);
    }
}
