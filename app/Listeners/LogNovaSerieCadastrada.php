<?php

namespace App\Listeners;

use App\Events\NovaSerieEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogNovaSerieCadastrada
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NovaSerieEvent  $event
     * @return void
     */
    public function handle(NovaSerieEvent $event)
    {
        $nomeSerie = $event->nome;
        $qntTemporada = $event->temporadas;
        $qntEpisodio = $event->episodios;

        \Log::info('Série nova cadastrada '. $nomeSerie);

    }
}
