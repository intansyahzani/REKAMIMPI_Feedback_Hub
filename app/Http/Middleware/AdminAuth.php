<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // ❌ Redirect if not logged in as admin
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login')->with('error', 'Please log in first.');
        }

        // ✅ Proceed with request
        $response = $next($request);

        // 🛡️ Apply cache prevention headers if response is NOT streamed (e.g., not file download)
        if (!$response instanceof StreamedResponse) {
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }

        return $response;
    }
}
