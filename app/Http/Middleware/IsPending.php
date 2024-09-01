<?php

namespace App\Http\Middleware;

use App\Models\PermissionRequest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsPending
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permission_pending =  PermissionRequest::where('user_id', Auth::id())
        ->where('status', 'bekliyor')
        ->where('expires_at', '>', now())
        ->first();

        if ($permission_pending) {
            return redirect()->route('permission.pending');
        }

        return $next($request);
    }
}
