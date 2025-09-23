<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function App\Http\Helpers\responseFail;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $type): Response
    {
        $user = $request->user();

        if (!$user || $user->type !== $type) {
            if ($request->expectsJson()) {
                return responseFail(
                    message: 'Unauthorized. You must be a ' . $type
                );
            }

            abort(403, 'Unauthorized.');
        }
        return $next($request);
    }
}
