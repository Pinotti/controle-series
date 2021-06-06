@extends('layout')

@section('cabecalho')
Episódios
@endsection

@section('conteudo')

    <form action="">
        @csrf
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>

        <ul class="list-group">
            @foreach($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episodio->numero }}
                    <input type="checkbox">
                </li>
            @endforeach
        </ul>
    </form>

@endsection