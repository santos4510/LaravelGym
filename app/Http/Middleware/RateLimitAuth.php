<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class RateLimitAuth extends ThrottleRequests
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $maxAttempts = 60, $decayMinutes = 1, $prefix = ''): \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
    {
        // Define stricter rate limiting for auth endpoints
        $key = match (true) {
            $request->is('api/auth/login') => 'login:' . $this->resolveRequestSignature($request),
            $request->is('api/auth/register') => 'register:' . $this->resolveRequestSignature($request),
            $request->is('api/auth/forgot') => 'forgot:' . $this->resolveRequestSignature($request),
            $request->is('api/auth/reset') => 'reset:' . $this->resolveRequestSignature($request),
            default => null,
        };

        if ($key) {
            if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Demasiados intentos. Por favor intenta más tarde.',
                    'retry_after' => RateLimiter::availableIn($key)
                ], Response::HTTP_TOO_MANY_REQUESTS);
            }
            RateLimiter::hit($key, $decayMinutes * 60);
            return $next($request);
        }

        // Para rotas não customizadas, delega para o método pai
        return parent::handle($request, $next, $maxAttempts, $decayMinutes, $prefix);
    }

    /**
     * Resolve request signature for rate limiting.
     */
    protected function resolveRequestSignature(Request $request): string
    {
        return hash('sha256', $request->method() . '|' . $request->ip() . '|' . $request->getHost());
    }
}
