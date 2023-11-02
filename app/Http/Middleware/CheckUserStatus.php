<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->status == 1) {
            return $next($request);
        }

        return redirect()->route('users.userinfo', ['id'=>auth()->user()->id])->with('msg', 'Mời bạn điền đầy đủ thông tin, sau đó chờ được duyệt trước khi sử dụng chức năng');
    }
}
