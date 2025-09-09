@extends('app.layouts.basico')

@section('titulo', 'Visualizar Cliente')

@section('conteudo')
<div class="conteudo-pagina">

    <div class="titulo-pagina-2">
        <p>Detalhes do Cliente: {{ $cliente->nome }}</p>
    </div>

    <div class="menu">
        <ul>
                <li><a href="{{ route('cliente.create') }}">Novo</a></li>
                <li><a href="{{ url()->previous() }}">Voltar</a></li>
        </ul>
    </div>

    <div class="informacao-pagina">
        <div style="width: 90%; margin: auto;">
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>Nome do Cliente</th>
                        <th>ID Pedido</th>
                        <th>Nome do Produto</th>
                          <th>Fornecedor</th>
                        <th>Quantidade</th>
                        <th>Data do Pedido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cliente->pedidos as $pedido)
                        @foreach($pedido->produtos as $produto)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $produto->nome }}</td>
                             <td>{{ $produto->fornecedor->nome ?? '-' }}</td>
                            <td>{{ $produto->pivot->quantidade }}</td>
                            <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
