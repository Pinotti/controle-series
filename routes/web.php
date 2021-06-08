<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NovaSerie;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/series', 'SeriesController@index')->name('listar_series');
Route::get('/series/criar', 'SeriesController@create')->name('form_criar_serie')->middleware('auth');
Route::post('/series/criar', 'SeriesController@store')->middleware('auth');
Route::delete('series/{id}', 'SeriesController@destroy')->middleware('auth');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')->middleware('auth');

Route::get('/series/{serie_d}/temporadas', 'TemporadasController@index');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function (){
    Auth::logout();
    return redirect('/entrar');
});

Route::get('visualizando-email', function() {
    return new \App\Mail\NovaSerie('Arrow', 5, 10);
});

Route::get('enviando-email', function() {
    $email = new NovaSerie('Arrow', 5, 10);
    $email->subject = 'Nova Série Adicionada';

    $user = (object)[
        'email' => 'anderson@email.com',
        'name' => 'Anderson'
    ];

    Mail::to($user)->send($email);
    return 'Email enviado';
});