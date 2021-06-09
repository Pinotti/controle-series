<?php

namespace App\Services;

use App\{Serie, Temporada};
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{

    public function criarSerie (string $nomeSerie, int $qtdTemporadas, int $epPorTemporada, ?string $capa) : Serie
    {
        DB::beginTransaction();
        $serie = Serie::create([
            'nome' => $nomeSerie,
            'capa' => $capa
            ]);
        $this->criaTemporadas($qtdTemporadas, $epPorTemporada, $serie);
        DB::commit();

        return $serie;
    }

    private function criaTemporadas(int $qtdTemporadas, int $epPorTemporada, Serie $serie) : void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }

    private function criaEpisodios(int $epPorTemporada, Temporada $temporada) : void
    {
        for ($i = 1; $i <= $epPorTemporada; $i++) {
            $temporada->episodios()->create(['numero' => $i]);
        }
    }
}