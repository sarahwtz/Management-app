@extends('app.layouts.basico')

@section('titulo','Produto')

@section('conteudo')
<div class="conteudo-pagina">

    <div class="titulo-pagina-2">
        <p>Consulta de Produto</p>
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ route('produto.create') }}">Novo</a></li>
            <li><a href="{{ route('produto.index') }}">Voltar</a></li>
        </ul>
    </div>

    <div class="informacao-pagina">
        <div style="width: 30%; margin: auto;">
            @component('app.produto._components.form_consulta', [
                'fornecedores' => $fornecedores,
                'unidades' => $unidades,
                'request' => $request ?? []
            ])
            @endcomponent
        </div>

        @if(isset($produtos) && $produtos->count() > 0)
            <div style="margin-top: 30px;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Fornecedor</th>
                            <th>Descrição</th>
                            <th>Peso</th>
                            <th>Unidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->fornecedor->nome ?? '' }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade->unidade ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $produtos->appends(request()->all())->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
