@extends('layout')

@section('cabecalho')Adicionar Série @endsection

@section('conteudo')
    <section class="container pt-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post">
            @csrf
            <div class="row">
                <div class="col col-8 mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nome"
                           placeholder="Digite o nome da série">
                </div>

                <div class="col col-2 mb-3">
                    <label for="temporadas" class="form-label">Temporadas</label>
                    <input type="number" class="form-control" id="temporadas" name="temporadas" aria-describedby="temporadas"
                           placeholder="nr de temporadas">
                </div>

                <div class="col col-2 mb-3">
                    <label for="episodios" class="form-label">Episódios</label>
                    <input type="number" class="form-control" id="episodios" name="episodios" aria-describedby="episodios"
                           placeholder="nr de episódios">
                </div>

            </div>
            <button type="submit" class="btn-sm btn-dark">Enviar</button>
        </form>
    </section>
@endsection
