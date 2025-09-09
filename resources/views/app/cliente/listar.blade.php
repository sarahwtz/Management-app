@extends('app.layouts.basico')

@section('titulo','Cliente')

@section('conteudo')

<div class="conteudo-pagina">

    <div class="titulo-pagina-2">
        <p>Listagem de Clientes</p>
    </div> 

    <div class="menu">
        <ul>
            <li><a href="{{ route('cliente.create') }}">Novo</a></li>
            <li><a href="{{ route('cliente.index') }}">Voltar</a></li>
        </ul>
    </div>  

    <div class="informacao-pagina">
        <div style="width: 90%; margin-left: auto; margin-right: auto;">
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                         
                            <td>
                                <a href="{{ route('cliente.show', ['cliente' => $cliente->id]+ request()->all()) }}">Visualizar</a> </td>
                                
                                
                                <td>
                                <a href="{{ route('cliente.edit', ['cliente' => $cliente->id]+ request()->all()) }}">Editar</a> </td>
                                <td>
                                <form id="form_{{ $cliente->id }}" method="post" action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="document.getElementById('form_{{ $cliente->id }}').submit()">Excluir</a>
                                </form> </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>  

            {{ $clientes->appends($request)->links() }} 

            <br>
            Exibindo {{ $clientes->count() }} clientes de {{ $clientes->total() }} (de {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }})
        </div>
    </div>        

</div>

@endsection
