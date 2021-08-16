<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\HasJsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class JsonWebToken
{
    use HasJsonResponse;

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Exception $exception) {
            if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->sendTokenErrorMessage('Токен недействителен!');
            } else if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->sendTokenErrorMessage('Срок действия токена истек');
            } else {
                return $this->sendTokenErrorMessage('Токен авторизации не найден!');
            }
        }

        return $next($request);
    }
}
