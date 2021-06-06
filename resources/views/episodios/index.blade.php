@extends('layout')

@section('cabecalho')
Episódios
@endsection

@section('conteudo')
    @include('mensagem', ['mensagem' => $mensagem])
    
    <form action="/temporadas/{{ $temporadaId }}/episodios/assistir" method="post">
        @csrf
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>

        <ul class="list-group">
            @foreach($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episodio->numero }}
                    <input type="checkbox" name="episodios[]" value="{{ $episodio->id }}" {{ $episodio->assistido ? 'checked' : '' }}>
                </li>
            @endforeach
        </ul>
    </form>

@endsection