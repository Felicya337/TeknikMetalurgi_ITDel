<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('admin')->check() && auth()->guard('admin')->user()->is_superadmin) {
            return $next($request);
        }
        return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki hak akses Super Admin.');
    }
}
