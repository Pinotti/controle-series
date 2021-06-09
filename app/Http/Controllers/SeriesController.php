<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Serie;
use App\Mail\NovaSerie;
use App\Http\Requests\SeriesFormRequest;
use App\Services\{CriadorDeSerie, RemovedorDeSerie};
use App\User;

class SeriesController extends Controller
{
    public function index(Request $request) 
    {
        $series = Serie::query()->orderBy('nome')->get();   
        $mensagem = $request->session()->get('mensagem');
        return view ('series.index', compact('series', 'mensagem'));
    }

    public function create ()
    {
        return view ('series.create');
    }

    public function store (SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        
        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->ep_por_temporada);

        $users = User::all();
        foreach ($users as $indice => $user)
        {
            $multiplicador = $indice + 1;

            $email = new NovaSerie($request->nome, $request->qtd_temporadas, $request->ep_por_temporada);
            $email->subject = 'Nova Série Adicionada';

            $quando = now()->addSecond($multiplicador * 10);
            Mail::to($user)->later($quando, $email);
        }
        
        $request->session()->flash("mensagem", "Série adicionada com sucesso.");

        return redirect()->route('listar_series');
    }

    public function destroy (Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        $request->session()->flash("mensagem", "Série $nomeSerie removida com sucesso.");

        return redirect()->route('listar_series');
    }

    public function editaNome (int $id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}