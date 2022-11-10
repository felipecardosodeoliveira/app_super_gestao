{{ $slot }}
{{-- @dd($motivo_contatos) --}}
<form action={{ route('site.contato') }} method="post">
    @csrf
    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="{{ $classe }}">
    @if ($errors->has('nome'))
        <span>{{ $errors->first('nome') }}</span>
    @endif
    <br>
    <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone" class="{{ $classe }}">
    @if ($errors->has('telefone'))
        <span>{{ $errors->first('telefone') }}</span>
    @endif
    <br>
    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="{{ $classe }}">
    @if ($errors->has('email'))
        <span>{{ $errors->first('email') }}</span>
    @endif
    <br>
    <select name="motivo_contatos_id" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>
        @foreach ($motivo_contatos as $chave => $motivo_contato)
            <option value="{{ $motivo_contato->id }}" {{ old('motivo_contatos_id') == $motivo_contato->id  ? 'selected' : '' }}> {{ $motivo_contato->motivo_contato }} </option>
        @endforeach
    </select>
    @if ($errors->has('motivo_contatos_id'))
        <span>{{ $errors->first('motivo_contatos_id') }}</span>
    @endif
    <br>
    <textarea name="mensagem" class="{{ $classe }}">{{ old('mensagem') ?  old('mensagem') : 'Peencha aqui a sua mensagem'}}</textarea>
    @if ($errors->has('mensagem'))
        <span>{{ $errors->first('mensagem') }}</span>
    @endif
    <br>
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>



