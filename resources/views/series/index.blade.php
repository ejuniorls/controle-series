@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')
    <section class="container pt-">
        <a href="{{ route('series.create') }}" class="btn btn-sm btn-dark my-3">Adicionar</a>

        <ul class="list-group">
            @foreach ($series as $serie)
            <li class="list-group-item"> {{ $serie }} </li>
            @endforeach
        </ul>
    </section>
@endsection
