@if (session('msg'))
    <div style="color: green; font-weight: bold; margin-bottom: 20px;">
        {{ session('msg') }}
    </div>
@endif

@if(isset($modo) && $modo == 'consulta')
    <form method="post" action="{{ route('produto.consulta') }}">
        @csrf
@else
    @if(isset($produto->id))
        <form method="post" action="{{ route('produto.update', ['produto' => $produto->id]) }}">
            @csrf
            @method('PUT')
    @else
        <form method="post" action="{{ route('produto.store') }}">
            @csrf
    @endif
@endif

<select name="fornecedor_id">
    <option value="">-- Selecione um Fornecedor --</option>
    @foreach($fornecedores as $fornecedor)
        <option value="{{ $fornecedor->id }}"
            {{ (old('fornecedor_id', $produto->fornecedor_id ?? '') == $fornecedor->id) ? 'selected' : '' }}>
            {{ $fornecedor->nome }}
        </option>
    @endforeach
</select>
@if ($errors->has('fornecedor_id'))
    <div style="color: black;">{{ $errors->first('fornecedor_id') }}</div>
@endif

<input type="text" name="nome"
       value="{{ old('nome', $produto->nome ?? '') }}"
       placeholder="Nome" class="borda-preta">
@if ($errors->has('nome'))
    <div style="color: black;">{{ $errors->first('nome') }}</div>
@endif

<input type="text" name="descricao"
       value="{{ old('descricao', $produto->descricao ?? '') }}"
       placeholder="Descrição" class="borda-preta">
@if ($errors->has('descricao'))
    <div style="color: black;">{{ $errors->first('descricao') }}</div>
@endif

<input type="text" name="peso"
       value="{{ old('peso', isset($produto->peso) ? sprintf('%.2f', $produto->peso) : '') }}"
       placeholder="Peso" class="borda-preta">
@if ($errors->has('peso'))
    <div style="color: black;">{{ $errors->first('peso') }}</div>
@endif

<select name="unidade_id">
    <option value="">-- Selecione a Unidade de Medida --</option>
    @foreach($unidades as $unidade)
        <option value="{{ $unidade->id }}"
            {{ (old('unidade_id', $produto->unidade_id ?? '') == $unidade->id) ? 'selected' : '' }}>
            {{ $unidade->unidade }}
        </option>
    @endforeach
</select>
@if ($errors->has('unidade_id'))
    <div style="color: black;">{{ $errors->first('unidade_id') }}</div>
@endif

<button type="submit" class="borda-preta">
    {{ (isset($modo) && $modo == 'consulta') ? 'Pesquisar' : (isset($produto->id) ? 'Atualizar' : 'Cadastrar') }}
</button>
</form>
