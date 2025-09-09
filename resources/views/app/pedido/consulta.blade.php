@extends('app.layouts.basico')

@section('titulo','Consulta de Pedidos')

@section('conteudo')
<div class="conteudo-pagina">

    <div class="titulo-pagina-2">
        <p>Consulta de Pedidos</p>
    </div> 


 <div class="menu">
        <ul>
                <li><a href="{{ route('pedido.create') }}">Novo</a></li>
                <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
        </ul>
    </div>

    <div class="informacao-pagina">
        <div style="width: 40%; margin: auto;">

            <form method="get" action="{{ route('pedido.listar') }}">
                
                <input type="text" name="pedido_id" placeholder="ID Pedido" class="borda-preta">
                <input type="text" name="cliente" placeholder="Cliente" class="borda-preta">
                <input type="text" name="produto" placeholder="Produto" class="borda-preta">
                <input type="text" name="fornecedor" placeholder="Fornecedor" class="borda-preta">
                <input type="text" name="quantidade" placeholder="Quantidade" class="borda-preta">
                <input type="date" name="data_inclusao" class="borda-preta">

                <button type="submit" class="borda-preta">Pesquisar</button>
            </form>

        </div>
    </div>        
</div>
@endsection
