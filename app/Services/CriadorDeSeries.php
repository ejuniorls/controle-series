<?php

namespace App\Services;

use App\Serie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CriadorDeSeries
{
    public function criarSerie(string $nomeSerie, int $temporadas, int $episodios): Serie
    {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie]);
        $this->criaTemporadas($temporadas, $episodios, $serie);
        DB::commit();

        return $serie;
    }

    /**
     * @param int $temporadas
     * @param $serie
     * @param int $episodios
     */
    public function criaTemporadas(int $temporadas, int $episodios, Serie $serie): void
    {
        for ($i = 1; $i <= $temporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criaEpisodios($episodios, $temporada);
        }
    }

    /**
     * @param int $episodios
     * @param mixed $temporada
     */
    public function criaEpisodios(int $episodios, Model $temporada): void
    {
        for ($j = 1; $j <= $episodios; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
