 {{ $slot }}
     {{-- 
 
 <form action={{ route('site.contato') }} method="post">
                    @csrf
                        <input name="name" value="{{ old('name') }}" type="text" placeholder="Nome" class="{{ $classe }}">
                        @if($errors->has('name'))
                        {{ $errors->first('name') }}
                        @endif

                        <br>
                        <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="telefone" class="{{ $classe }}">

                        {{ $errors->has('telefone') ? $errors->first('telefone') : '' }}


                        <br>
                        <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="{{ $classe }}">

                        {{ $errors->has('email') ? $errors->first('email') : '' }}
                        <br>

                
                        <select name= "motivo_contatos_id" class="{{ $classe }}">
                        
                            <option value="">Qual o motivo do contato?</option>

                            @foreach($motivo_contatos as $key => $motivo_contato)
                                <option value="{{$motivo_contato->id}}" {{ old('motivo_contatos_id') == $motivo_contato->id ? 'selected' : '' }}> {{$motivo_contato->motivo_contato}}</option>
                                @endforeach
                            <br>
                      

                        {{ $errors->has('motivo_contatos_id') ? $errors->first('motivo_contatos_id') : '' }}
                        </select>
                        <br>
                        <textarea name="mensagem" class="{{ $classe }}">{{(old('mensagem') !='') ? old('mensagem') : 'Preencha aqui a sua mensagem'}}
                        </textarea>
                        {{ $errors->has('mensagem') ? $errors->first('mensagem') : '' }}
                        
                        <br>
                        <button type="submit" class="borda-preta">ENVIAR</button>
                    </form>
                
                    @if($errors->any())

                    @foreach($errors->all() as $erro)
                    {{ $erro }}
                    <br>
                    @endforeach
                    @endif
                     --}}










    <form action="{{ route('site.contato') }}" method="post">
    @csrf
    <input name="name" value="{{ old('name') }}" type="text" placeholder="Nome" class="{{ $classe }}">
    @if($errors->has('name'))
        <div class="error">{{ $errors->first('name') }}</div>
    @endif

    <br>
    <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone" class="{{ $classe }}">
    @if($errors->has('telefone'))
        <div class="error">{{ $errors->first('telefone') }}</div>
    @endif

    <br>
    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="{{ $classe }}">
    @if($errors->has('email'))
        <div class="error">{{ $errors->first('email') }}</div>
    @endif
    <br>

    <select name="motivo_contatos_id" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>
        @foreach($motivo_contatos as $key => $motivo_contato)
            <option value="{{ $motivo_contato->id }}" {{ old('motivo_contatos_id') == $motivo_contato->id ? 'selected' : '' }}>
                {{ $motivo_contato->motivo_contato }}
            </option>
        @endforeach
    </select>
    @if($errors->has('motivo_contatos_id'))
        <div class="error">{{ $errors->first('motivo_contatos_id') }}</div>
    @endif

    <br>
    <textarea name="mensagem" class="{{ $classe }}">{{ old('mensagem') != '' ? old('mensagem') : 'Preencha aqui a sua mensagem' }}</textarea>
    @if($errors->has('mensagem'))
        <div class="error">{{ $errors->first('mensagem') }}</div>
    @endif

    <br>
    <button type="submit" class="borda-preta">ENVIAR</button>
</form>
