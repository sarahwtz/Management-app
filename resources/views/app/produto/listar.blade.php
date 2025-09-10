@extends('app.layouts.basico')

@section('titulo','Produtos - Resultados da Pesquisa')

@section('conteudo')

<div class="conteudo-pagina">

    <div class="titulo-pagina-2">
        <p>Resultados da Pesquisa de Produtos</p>
    </div> 

    <div class="menu" style="margin-bottom: 20px;">
        <ul>
            
            <li><a href="{{ route('produto.consulta') }}">Consulta</a></li>
            <li><a href="{{ route('produto.index') }}">Voltar</a></li>
        </ul>
    </div>  

    <div class="informacao-pagina">
        <div style="width: 90%; margin-left: auto; margin-right: auto;">
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Fornecedor</th>
                        <th>Site do Fornecedor</th>
                        <th>Peso</th>
                        <th>Unidade</th>
                       
                       
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($produtos as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->descricao }}</td>
                            <td>{{ $produto->fornecedor->nome ?? '' }}</td>
                            <td>{{ $produto->fornecedor->site ?? '' }}</td>
                            <td>{{ $produto->peso }}</td>
                            <td>{{ $produto->unidade->unidade ?? '' }}</td>
                          
                            {{--  <td><a href="{{ route('produto.show',['produto' => $produto->id]) }}">Visualizar</a></td>
                            <td>--}}

                            <td>
                            <a href="{{ route('produto.show', ['produto' => $produto->id, 'page' => request('page', 1)]) }}">
                             Visualizar </a></td>

                                <td><a href="{{ route('produto.edit', ['produto' => $produto->id]) }}">Editar</a></td>
                                  <td>
                                <form id="form_{{ $produto->id }}" method="post" action="{{ route('produto.destroy', ['produto' => $produto->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <a href="#" onclick="document.getElementById('form_{{ $produto->id }}').submit()">Excluir</a>
                                </form>
                            </td>
                           
                        </tr>
                        <tr>
                            <td colspan="12">
                                <p>Pedidos</p>
                                @foreach($produto->pedidos as $pedido)
                                    <a href="{{ route('pedido-produto.create', ['pedido' => $pedido->id]) }}">
                                        Pedido: {{ $pedido->id }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>  

            {{ $produtos->appends($request)->links() }}

            <br>
            Exibindo {{ $produtos->count() }} produtos de {{ $produtos->total() }} (de {{ $produtos->firstItem() }} a {{ $produtos->lastItem() }})

        </div>
    </div>        

</div>

@endsection
