<?php

namespace App\Providers;

use App\Events\{NovaSerie, SerieApagada};
use App\Listeners\{EnviarEmailNovaSerieCadastrada, ExcluirCapaSerie, LogNovaSerieCadastrada};
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NovaSerie::class => [
            EnviarEmailNovaSerieCadastrada::class,
            LogNovaSerieCadastrada::class,
        ],
        //SerieApagada::class => [
        //    ExcluirCapaSerie::class
        //]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
