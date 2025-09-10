<form method="post" action="{{ route('produto.listar') }}">
    @csrf

    <select name="fornecedor_id">
        <option value="">-- Selecione um Fornecedor --</option>
        @foreach($fornecedores as $fornecedor)
            <option value="{{ $fornecedor->id }}" {{ ($request['fornecedor_id'] ?? '') == $fornecedor->id ? 'selected' : '' }}>
                {{ $fornecedor->nome }}
            </option>
        @endforeach
    </select>

    <input type="text" name="nome" placeholder="Nome" value="{{ $request['nome'] ?? '' }}" class="borda-preta">
    <input type="text" name="descricao" placeholder="Descrição" value="{{ $request['descricao'] ?? '' }}" class="borda-preta">

    <input type="text" name="peso" placeholder="Peso"
           value="{{ isset($request['peso']) && $request['peso'] !== '' ? sprintf('%.2f', (float) str_replace(',', '.', $request['peso'])) : '' }}"
           class="borda-preta">

    <select name="unidade_id">
        <option value="">-- Selecione a Unidade --</option>
        @foreach($unidades as $unidade)
            <option value="{{ $unidade->id }}" {{ ($request['unidade_id'] ?? '') == $unidade->id ? 'selected' : '' }}>
                {{ $unidade->unidade }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="borda-preta">Pesquisar</button>
</form>
