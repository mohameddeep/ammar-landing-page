<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Counts each visitor once, ever. A long-lived cookie marks returning visitors,
 * so the database is only touched on a visitor's first request.
 */
final class TrackVisitor
{
    private const COOKIE = 'visitor_id';

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldTrack($request) && ! $request->cookie(self::COOKIE)) {
            try {
                // Fallback to a hash of IP + user agent so cookie-less clients are not recounted.
                $hash = hash('sha256', $request->ip().'|'.$request->userAgent().'|'.config('app.key'));

                DB::table('visitors')->insertOrIgnore([
                    'visitor_hash' => $hash,
                    'locale' => app()->getLocale(),
                    'first_path' => mb_substr('/'.ltrim($request->path(), '/'), 0, 255),
                    'first_visited_at' => now(),
                ]);

                Cookie::queue(self::COOKIE, substr($hash, 0, 16), 60 * 24 * 365 * 5);
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return $next($request);
    }

    private function shouldTrack(Request $request): bool
    {
        if (! $request->isMethod('GET') || $request->ajax() || $request->expectsJson()) {
            return false;
        }

        if ($request->user()) {
            return false;
        }

        $agent = (string) $request->userAgent();

        return $agent !== '' && ! preg_match('/bot|crawl|spider|slurp|facebookexternalhit|preview|monitor|curl|wget|python|httpclient|lighthouse/i', $agent);
    }
}
