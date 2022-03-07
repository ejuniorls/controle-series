<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();

        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
//        dd([$request->nome, $request->temporadas, $request->episodios]);
        $serie = Serie::create(['nome' => $request->nome]);
        $qtd_temporadas = $request->temporadas;
        for ($i = 1; $i <= $qtd_temporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ($j = 1; $j <= $request->episodios; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }

        $request
            ->session()
            ->flash("mensagem", "Série $serie->nome e suas temporadas e episódios adicionados com sucesso!");

        return redirect('/series');
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Série removida com sucesso"
            );

        return redirect('/series');
    }
}
