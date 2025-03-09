<?php

namespace App\Http\Middleware;

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
        //verifica se o usuario possui acesso à rota:
       if(true) {
        return $next($request);
       } else {
       return Response('Acesso negado! Rota exige autenticacao!!!');
    }
        }
}
 