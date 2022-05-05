<?php

namespace App\Listeners;

use App\Events\NovaSerieEvent;
use App\Mail\NovaSerie;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovaSerieCadastrada implements ShouldQueue
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

        $users = User::all();
        foreach ($users as $index => $user) {
            $x = $index + 1;
            $email = new NovaSerie($nomeSerie, $qntTemporada, $qntEpisodio);
            $email->subject = 'Nova série adicionada';
            $when = now()->addSecond($x * 5);
            Mail::to($user)->later($when, $email);
        }
    }
}
