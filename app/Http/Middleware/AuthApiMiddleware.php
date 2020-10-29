<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Auth;


class AuthApiMiddleware
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
        try{
            $token = JWTAuth::getToken();
            $userCheck = JWTAuth::toUser($token);
            if($userCheck) {
                return $next($request);
            } else {
                return response()->error(['message' => 'Unauthorised'], Response::HTTP_UNAUTHORIZED);
            }
        } catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->error('',['message'=>'Login failed'], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            if ($e->getMessage() === 'A token is required') {
                return response()->error('',['message'=>'Token required'], Response::HTTP_RESET_CONTENT);
            }
            Log::error($e);
            return response()->error('',['message'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
