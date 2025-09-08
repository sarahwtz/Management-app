@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')
    <div class="topo">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}">
        </div>
        <div class="menu">
            <ul>
                @if(session('success'))
                    <li><a href="{{ route('app.home') }}">Home</a></li>
                @endif
                <li><a href="{{ route('cadastro.create') }}">Cadastrar</a></li>
                <li><a href="{{ route('site.index') }}">Principal</a></li>
                <li><a href="{{ route('site.sobrenos') }}">Sobre Nós</a></li>
                <li><a href="{{ route('site.contato') }}">Contato</a></li>
            </ul>
        </div>
    </div>

    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Cadastro</h1>
        </div>

        <div class="informacao-pagina">
            <div style="width:30%; margin-left:auto; margin-right:auto;">
                @if(session('success'))
                    <div class="sucesso">{{ session('success') }}</div>
                @endif

                <form action="{{ route('cadastro.store') }}" method="post">
                    @csrf

                    <input name="name" value="{{ old('name') }}" type="text" placeholder="Nome" class="borda-preta">
                    @if($errors->has('name'))
                        <div class="erro">{{ $errors->first('name') }}</div>
                    @endif

                    <input name="email" value="{{ old('email') }}" type="email" placeholder="Email" class="borda-preta">
                    @if($errors->has('email'))
                        <div class="erro">{{ $errors->first('email') }}</div>
                    @endif

                    <input name="password" type="password" placeholder="Senha" class="borda-preta">
                    @if($errors->has('password'))
                        <div class="erro">{{ $errors->first('password') }}</div>
                    @endif

                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="rodape">
        <div class="redes-sociais">
            <h2>Redes sociais</h2>
            <img src="{{ asset('img/facebook.png') }}">
            <img src="{{ asset('img/linkedin.png') }}">
            <img src="{{ asset('img/youtube.png') }}">
        </div>
        <div class="area-contato">
            <h2>Contato</h2>
            <span>(11) 3333-4444</span>
            <br>
            <span>supergestao@dominio.com.br</span>
        </div>
        <div class="localizacao">
            <h2>Localização</h2>
            <img src="{{ asset('img/mapa.png') }}">
        </div>
    </div>
@endsection
