@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')
    <section class="container pt-">
        <a href="{{ route('series.create') }}" class="btn btn-sm btn-dark my-3">Adicionar</a>

        @if (!empty($mensagem))
            <div class="alert alert-success" role="alert">
                {{ $mensagem }}
            </div>
        @endif

        <ul class="list-group">
            @foreach($series as $serie)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $serie->nome }}

                    <div class="d-flex">
                        <a href="{{ route('temporadas.index', $serie->id ) }}" class="btn btn-info me-2">
                            <i class="fas fa-external-link-alt"></i>
                        </a>

                        <form method="post" action="/series/{{ $serie->id}}" onsubmit="return confirm('Tem certeza?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </li>

            @endforeach
        </ul>

    </section>
@endsection
