<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\NovaSerie;
use App\Serie;
use App\Services\CriadorDeSeries;
use App\Services\RemovedorDeSeries;
use App\Temporada;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function store(SeriesFormRequest $request, CriadorDeSeries $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie($request->nome, $request->temporadas, $request->episodios);

        $users = User::all();
        foreach ($users as $user) {
            $email = new NovaSerie($request->nome, $request->temporadas, $request->episodios);
            $email->subject = 'Nova série adicionada';
            Mail::to($user)->send($email);
            sleep(5);
        }

        $request
            ->session()
            ->flash("mensagem", "Série $serie->nome e suas temporadas e episódios adicionados com sucesso!");

        return redirect('/series');
    }

    public function destroy(Request $request, RemovedorDeSeries $removedorDeSeries)
    {
        $serie = $removedorDeSeries->removerSerie($request->id);

        $request->session()
            ->flash(
                'mensagem',
                "Série removida com sucesso"
            );

        return redirect('/series');
    }

    public function put(int $id, Request $request)
    {
        $nome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $nome;
        $serie->save();
    }
}
