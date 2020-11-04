<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            session()->flash('error', 'Vui lòng đăng xuất để trở lại trang đăng nhập');
            return redirect('admin');
        } else {
            return $next($request);
        }
    }
}
