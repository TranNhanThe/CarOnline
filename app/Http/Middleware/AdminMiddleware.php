<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Kiểm tra xem người dùng đã đăng nhập và có quyền admin không
        
            return $next($request);
       

        // Nếu không có quyền admin, bạn có thể chuyển hướng hoặc trả về lỗi 403
      

        // Hoặc chuyển hướng về trang khác
        // return redirect('/login')->with('error', 'Access denied.');
    }
}
