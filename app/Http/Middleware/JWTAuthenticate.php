<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Contracts\Auth\Factory as Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class JWTAuthenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $header = $request->header('Authorization');

            // Check if type token is not bearer, return 401
            if (strtolower(substr($header, 0, 7)) !== 'bearer ') {
                return response()->json(['message' => 'Token is Invalid!'], 401);
            }

            // Check token == users true
            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Users not found!'], 401);
            }

            return $next($request);
        } catch (Exception $e) {
            if ($e instanceof TokenBlacklistedException){
                return response()->json(['message' => 'Token has been blacklisted!'], 401);
            } else if ($e instanceof TokenExpiredException){
                return response()->json(['message' => 'Token is Expired!'], 401);
            } else if ($e instanceof JWTException){
                return response()->json(['message' => 'Token not Parsed!'], 401);
            } else if ($e instanceof TokenInvalidException){
                return response()->json(['message' => 'Token is Invalid!'], 401);
            } else{
                return response()->json(['message' => 'Authorization Token not found!'], 401);
            }
        }
    }
}
