<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Token;

class ProtectViewsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $cookie = Cookie::get('check-employee');
        $token = Token::find(1);


        if($cookie != null && $cookie == $token->remember_token)
        return $next($request);

        return redirect()->route('confirm.password', ['code' => $request->route('code')]);
    }
}
