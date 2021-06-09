<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmailNovaSerieCadastrada
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
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $users = User::all();
        foreach ($users as $indice => $user)
        {
            $multiplicador = $indice + 1;

            $email = new \App\Mail\NovaSerie($event->nomeSerie, $event->qtdTemporadas, $event->qtdEpisodios);
            $email->subject = 'Nova Série Adicionada';

            $quando = now()->addSecond($multiplicador * 10);
            Mail::to($user)->later($quando, $email);
        }
    }
}
