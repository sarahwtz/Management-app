<!DOCTYPE html>
<html lang="pt-br">
    <head>
       <title>Super Gestao - @yield('titulo')</title>
        <meta charset="utf-8">

         <link rel="stylesheet" href="{{ asset('CSS/estilo_basico.css') }}">
    </head>

    <body>
   @include('site.layouts._partials.topo')
    @yield('conteudo')
 </body>

</html>