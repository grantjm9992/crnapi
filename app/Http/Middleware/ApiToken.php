<?php

namespace App\Http\Middleware;

use  \App\User;
use Closure;


class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!is_object(self::getUserFromRequest($request))) {
            return false;
        }
        return $next($request);
    }

    public static function getTokenFromRequest(\Illuminate\Http\Request $request)
    {
        $authWithBearer = $request->header('Authorization');
        return substr($authWithBearer, 7);
    }

    public static function getUserFromRequest(\Illuminate\Http\Request $request)
    {
        $apiToken = self::getTokenFromRequest($request);
        return User::where('api_token', $apiToken)->first();
    }
}
