@extends('layout')

@section('cabecalho')
    Episódios
@endsection

@section('conteudo')
    <section class="container pt-">

        @includeWhen(!empty($mensagem), 'alert',  ['mensagem' => $mensagem])

        <article id="formulario" class="mt-3">
            <form action="{{ route('episodios.assistir', $temporadaId ) }}" method="post">
                @csrf
                <ul class="list-group">
                    @foreach($episodios as $episodio)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Episódio {{ $episodio->numero }}
                            <input type="checkbox" name="episodios[]"
                                   value="{{ $episodio->id }}" {{ $episodio->assistido ? 'checked' : '' }}>
                        </li>
                    @endforeach
                </ul>

                <button class="btn btn-dark mt-3" type="submit">Salvar</button>
            </form>
        </article>
    </section>
@endsection


