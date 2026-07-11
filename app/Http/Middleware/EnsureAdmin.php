<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Ensure the authenticated user has an admin role.
     * Super Admin can access everything.
     * Editor can access content management but not user management.
     */
    public function handle(Request $request, Closure $next, string $level = 'admin'): Response
    {
        $user = $request->user();

        if (!$user || !$user->role) {
            abort(403, 'Unauthorized access.');
        }

        $slug = $user->role->slug;

        // Super Admin can access everything
        if ($slug === 'super-admin') {
            return $next($request);
        }

        // Editor can access content but not user/role management
        if ($slug === 'editor' && $level !== 'super-admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized access. Insufficient permissions.');
    }
}
