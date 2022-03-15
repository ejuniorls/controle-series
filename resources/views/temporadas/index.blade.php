@extends('layout')

@section('cabecalho')
    Temporadas de {{ $serie->nome }}
@endsection

@section('conteudo')
    <section class="container pt-">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark my-3">Voltar</a>

        @if (!empty($mensagem))
            <div class="alert alert-success" role="alert">
                {{ $mensagem }}
            </div>
        @endif

        <ul class="list-group">
            @foreach($temporadas as $temporada)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('episodios.index', $temporada->id ) }}"
                       class="text-decoration-none">Temporada {{ $temporada->numero }}</a>

                    <span class="badge bg-secondary">
                        {{ $temporada->getEpisodiosAssistidos()->count() }}/ {{ $temporada->episodios->count() }}
                    </span>
                </li>
            @endforeach
        </ul>

    </section>
@endsection
