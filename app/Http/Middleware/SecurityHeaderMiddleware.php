<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaderMiddleware
{
    /** 
     * Global Security Header Middleware
     * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers#security 
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Generate a random nonce for each request and share it with the views
        // (for Content-Security-Policy - script-src - instead of 'unsafe-inline')
        $cspNonce = bin2hex(random_bytes(16));
        View::share('cspNonce', $cspNonce);

        /** @var Response $response */
        $response = $next($request);
        try {
            $headersToAdd = $this->getAllSecurityHeadersToAdd($cspNonce);
            $headersToRemove = $this->getAllSecurityHeadersToRemove();

            // Update the API Response Headers
            foreach ($headersToAdd as $key => $value) {
                $response->headers->set($key, $value, true); // Replace existing => true
            }
            foreach ($headersToRemove as $key) {
                $response->headers->remove($key);
            }


            return $response;
        } catch (\Throwable $th) {
            // Middleware Exceptions: Log immediately and abort/fail with a "clean" response
            Log::error("SecurityHeaderMiddleware: " . $th->getMessage());
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #region PRIVATE FUNCTIONS

    private function getAllSecurityHeadersToAdd($cspNonce): array
    {
        return array_merge(
            // Simple/Hardcoded Headers, that will (most likely) never change
            [
                'X-Content-Type-Options' => 'nosniff',
                'X-Frame-Options' => 'SAMEORIGIN',
                'X-XSS-Protection' => '1; mode=block',
                'X-Permitted-Cross-Domain-Policies' => 'none',
                'Referrer-Policy' => 'no-referrer-when-downgrade',
                'Permissions-Policy' => 'geolocation=(self), microphone=(), camera=(), payment=()',
            ],
            // Complex/Variable Headers, that might change (Based on ENV, based on Frontend)
            [
                'Cross-Origin-Resource-Policy' => 'same-origin',
                'Cross-Origin-Embedder-Policy' => 'require-corp',
                'Cross-Origin-Opener-Policy' => 'same-origin',
                // CSP: unsafe-eval is required for AlpineJS
                'Content-Security-Policy' => trim(
                    "default-src 'self'; " .
                    "script-src 'self' 'unsafe-eval' 'nonce-{$cspNonce}'; " .
                    "script-src-elem 'self' https://www.google-analytics.com; " .
                    "style-src 'self' https://fonts.googleapis.com; " .
                    "font-src 'self' https://fonts.gstatic.com; " .
                    "object-src 'none'; " .
                    "frame-ancestors 'none'; "
                ),
                // Cache control (prevent browsers from storing data)
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
            ],
                // Production ENV only Headers
            (app()->environment('production') ? [
                // HSTS (Forces HTTPS)
                'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains; preload',
            ] : [])
        );
    }

    private function getAllSecurityHeadersToRemove(): array
    {
        return [
            // X-Powered-By must be removed in the php.ini
            // (find the ini "> php --ini" and set "expose_php = Off")
            'X-Powered-By',
            'X-Developed-By'
        ];
    }

    #endregion
}
