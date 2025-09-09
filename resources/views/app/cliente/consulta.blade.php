@extends('app.layouts.basico')
@section('titulo','Consulta de Clientes')
@section('conteudo')
<div class="conteudo-pagina">
    <div class="titulo-pagina-2">
        <p>Consulta de Clientes</p>
    </div>

<div class="menu">
        <ul>
            <li><a href="{{ route('cliente.create') }}">Novo</a></li>
            <li><a href="{{ route('cliente.index') }}">Voltar</a></li>        
   </ul>
    </div> 
    <div class="informacao-pagina">
        <div style="width: 30%; margin-left: auto; margin-right: auto;">
            <form method="get" action="{{ route('cliente.listar') }}">
                @csrf
                <input type="text" name="nome" value="{{ old('nome') }}" placeholder="Nome" class="borda-preta">
                @if ($errors->has('nome'))
                    <div style="color:red;">{{ $errors->first('nome') }}</div>
                @endif
                <button type="submit" class="borda-preta">Pesquisar</button>
            </form>
        </div>
    </div>        
</div>
@endsection
