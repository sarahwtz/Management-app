@extends('app.layouts.basico')

@section('titulo','Listagem de Pedidos')

@section('conteudo')
<div class="conteudo-pagina">

    <div class="titulo-pagina-2">
        <p>Listagem de Pedidos</p>
    </div> 

    <div class="menu">
        <ul>
            <li><a href="{{ route('pedido.create') }}">Novo</a></li>
            <li><a href="{{ route('pedido.consulta') }}">Consulta</a></li>
        </ul>
    </div>  

    <div class="informacao-pagina">
        <div style="width: 90%; margin: auto;">

            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Fornecedor</th>
                        <th>Quantidade</th>
                        <th>Data Inclusão</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        @foreach($pedido->itens as $item)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->cliente->nome }}</td>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->fornecedor->nome }}</td>
                            <td>{{ $item->pivot->quantidade }}</td>
                            <td>{{ $item->pivot->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>  

            {{ $pedidos->appends($request->all())->links() }}

            <br>
            Exibindo {{ $pedidos->count() }} pedidos de {{ $pedidos->total() }}
            (de {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }})

        </div>
    </div>        

</div>
@endsection
