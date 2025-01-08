

<h3>Fornecedor</h3>





@forelse($fornecedores as $indice => $fornecedor)

@add($loop)

iteracao atual {{$loop -> iteration}}
<br>
    Fornecedor: {{ $fornecedor ['nome'] }}
    <br>
    Status: {{ $fornecedor ['status'] }}
    <br>
    CNPJ: {{ $fornecedor ['cnpj'] ?? 'Dado nao foi preenchido' }}
    <br>
    Telefone: ({{ $fornecedor ['ddd'] ?? '' }}) {{ $fornecedor ['telefone'] ?? '' }}
    <br>
    @if($loop->first)
    Primeira iteracao do loop
    @endif

    @if($loop->last)
    Ultima iteracao do loop

    <br>
    Total de registros: {{$loop ->count}}
    @endif
    <hr>
    @empty
    Nao existem fornecedores cadastrados!!!
@endforelse








