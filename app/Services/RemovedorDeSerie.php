<?php

namespace App\Services;

use App\{Serie, Temporada, Episodio};
use App\Events\SerieApagada;
use App\Jobs\ExcluirCapaSerie;
use Illuminate\Support\Facades\DB;
Use Storage;

class RemovedorDeSerie
{

    public function removerSerie(int $serieId) : string
    {
        DB::beginTransaction();
        $serie = Serie::find($serieId);
        $serieObj = (object) $serie->toArray();
        $nomeSerie = $serie->nome;
        $this->removerTemporadas($serie);
        $serie->delete();

        $evento = new SerieApagada($serieObj);
        event($evento);
        ExcluirCapaSerie::dispatch($serieObj);
        DB::commit();
        
        return $nomeSerie;
    }

    private function removerTemporadas(Serie $serie) : void
    {
        $serie->temporadas->each(function (Temporada $temporada){
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    private function removerEpisodios(Temporada $temporada) : void
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }

}