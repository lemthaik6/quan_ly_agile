<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Kiểm tra xem người dùng có phải là quản trị viên không
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'quan_tri') {
            abort(403, 'Bạn không có quyền truy cập trang quản trị viên');
        }

        return $next($request);
    }
}
