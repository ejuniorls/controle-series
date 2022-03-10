<?php

namespace App\Services;

use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSeries
{
    public function removerSerie(int $serie): string
    {
        DB::beginTransaction();
        $serie = Serie::find($serie);
        $nomeSerie = $serie->nome;
        $this->removerTemporadas($serie);
        $serie->delete();
        DB::commit();

        return $nomeSerie;
    }

    /**
     * @param $serie
     * @throws \Exception
     */
    private function removerTemporadas($serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    /**
     * @param Temporada $temporada
     * @throws \Exception
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}
