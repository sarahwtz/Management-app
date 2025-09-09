
@extends('app.layouts.basico')

@section('titulo','Cliente')

@section('conteudo')

<div class="conteudo-pagina">

    <div class="titulo-pagina-2">    
        <p>Editar Cliente</p>
    </div> 

    <div class="menu">
    <ul>
    <li><a href="{{ route('cliente.index') }}">Consulta</a></li>
    <li><a href="{{ url()->previous() }}">Voltar</a></li>
    </ul>
        </div>  

            <div class="informacao-pagina">
              <div style="width: 30%; margin-left: auto; margin-right: auto;">
                  @include('app.cliente._components.form_create_edit', ['cliente' => $cliente])

                 

            </div>

        </div>

            
</div>        

@endsection