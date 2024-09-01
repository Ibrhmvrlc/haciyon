<?php

namespace App\Http\Middleware;

use App\Models\PermissionRequest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsTherePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permission = PermissionRequest::where('user_id', Auth::id())
        ->where('status', 'onaylandi')
        ->where('expires_at', '>', now())
        ->first();

        $permission_pending =  PermissionRequest::where('user_id', Auth::id())
        ->where('status', 'bekliyor')
        ->where('expires_at', '>', now())
        ->first();

        if (!$permission and !$permission_pending) {
            return redirect()->route('showInfo')->with('error', 'Geçerli izniniz yok.');
        }

        return $next($request);
    }
}
