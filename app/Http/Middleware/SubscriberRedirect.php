<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriberRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response {

        $user = auth()->user();
        $totalColumnsCreatedByUser = $user->columns()->count();

        if ($user && !$user->subscribed() && $totalColumnsCreatedByUser < 3) {
            return $next($request);
        } elseif ($user && $user->subscribed()) {
            return $next($request);
        }

        return to_route('subscription-plan');
    }
}
