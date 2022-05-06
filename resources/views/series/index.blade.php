@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')
    <section class="container pt-">
        @auth
            <a href="{{ route('series.create') }}" class="btn btn-sm btn-dark mt-3">Adicionar</a>
        @endauth

        @includeWhen(!empty($mensagem), 'alert',  ['mensagem' => $mensagem])

        <ul class="list-group mt-3">
            @foreach($series as $serie)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <img src="{{ $serie->capa_url }}" class="img-thumbnail" height="100px" width="100px" alt="">
                        <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
                    </div>

                    <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                        <input type="text" class="form-control" value="{{ $serie->nome }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                                <i class="fas fa-check"></i>
                            </button>
                            @csrf
                        </div>
                    </div>

                    <div class="d-flex">
                        @auth
                            <button class="btn btn-secondary btn-sm me-2" onclick="toggleInput({{ $serie->id }})">
                                <i class="bi bi-pencil"></i>
                            </button>
                        @endauth

                        <a href="{{ route('temporadas.index', $serie->id ) }}"
                           class="btn btn-secondary btn-sm me-2">
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>

                        @auth
                            <form method="post" action="/series/{{ $serie->id}}"
                                  onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endauth
                    </div>
                </li>

            @endforeach
        </ul>

    </section>

    <script>
        function toggleInput(serieId) {
            const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
            const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
            if (nomeSerieEl.hasAttribute('hidden')) {
                nomeSerieEl.removeAttribute('hidden');
                inputSerieEl.hidden = true;
            } else {
                inputSerieEl.removeAttribute('hidden');
                nomeSerieEl.hidden = true;
            }
        }

        function editarSerie(serieId) {
            let formData = new FormData();

            const nome = document.querySelector(`#input-nome-serie-${serieId} > input`).value;
            const token = document.querySelector('input[name="_token"]').value;

            formData.append('nome', nome);
            formData.append('_token', token);

            // enviar para rota
            const url = `/series/${serieId}/editaNome`;

            // fazer requisição para url
            fetch(url, {
                body: formData,
                method: 'POST'
            }).then(() => {
                toggleInput(serieId);
                document.getElementById(`nome-serie-${serieId}`).textContent = nome;
            });
        }
    </script>
@endsection


