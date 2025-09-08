<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $metodo_autenticacao)
    {
       

      if (Auth::check()) {
        return $next($request);
       } else {
        return redirect()->route('site.login', ['erro' =>2]);
       }
    }
        
}
 