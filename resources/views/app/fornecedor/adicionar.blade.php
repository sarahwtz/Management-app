
@extends('app.layouts.basico')

@section('titulo','Fornecedor')

@section('conteudo')

<div class="conteudo-pagina">

    <div class="titulo-pagina-2">
        <p>Fornecedor - Adicionar</p>
    </div> 

    <div class="menu">
    <ul>
    <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
    <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>

    </ul>
        </div>  

            <div class="informacao-pagina">

             {{-- Só mostra a mensagem de sucesso se NÃO houver erros --}}
    @if (!$errors->any() && isset($msg))
        <div style="color: green; font-weight: bold;">
            {{ $msg }}
        </div>
    @endif

  
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form method="post" action="{{ route('app.fornecedor.adicionar') }}">
                <input type="hidden" name="id" value="{{ $fornecedor->id ?? ''}}">
                @csrf
                    <input type="text" name="nome" value="{{ $fornecedor->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
                    {{  $errors->has('nome') ? $errors->first('nome') : '' }}

                    <input type="text" name="site" value="{{ $fornecedor->site ?? old('site') }}" placeholder ="Site" class="borda-preta">
                    {{  $errors->has('site') ? $errors->first('site') : '' }}

                    <input type="text" name="UF" value="{{ $fornecedor->UF ?? old('UF') }}" placeholder= "UF" class="borda-preta">
                    {{  $errors->has('UF') ? $errors->first('UF') : '' }}

                    <input type="text" name="email" value="{{ $fornecedor->email ?? old('email') }}"placeholder="E-mail" class="borda-preta">
                    {{  $errors->has('email') ? $errors->first('email') : '' }}


                    <button type="submit" class="borda-preta">Cadastrar</button>
                 <form>   

            </div>
</div>        

@endsection