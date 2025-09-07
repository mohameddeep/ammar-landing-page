<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckType
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next,$type): Response
    {
        if(auth('api')->check() && auth('api')->user()->type != $type){
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        if(!auth('api')->check() && auth('api')->user()->currentSubscription && !auth('api')->user()->currentSubscription->is_active){
            return response()->json(['message' => 'Your subscription is not active'], 403);
        }

        return $next($request);
    }
}
