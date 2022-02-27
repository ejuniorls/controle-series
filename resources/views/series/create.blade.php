@extends('layout')

@section('cabecalho')Adicionar Série @endsection

@section('conteudo')
    <section class="container pt-3">
        <form method="post">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nome"
                       placeholder="Digite o nome da série">
            </div>

            <button type="submit" class="btn-sm btn-dark">Enviar</button>
        </form>
    </section>
@endsection
