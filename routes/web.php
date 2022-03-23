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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'series'], function () {
    Route::get('/', 'SeriesController@index')->name('series.index');
    Route::get('/{serieId}/temporadas', 'TemporadasController@index')->name('temporadas.index');

    Route::group(['middleware' => 'autenticador'], function () {
        Route::get('/criar', 'SeriesController@create')->name('series.create');
        Route::post('/criar', 'SeriesController@store')->name('series.store');
        Route::delete('/{id}', 'SeriesController@destroy')->name('series.delete');
        Route::post('/{id}/editaNome', 'SeriesController@put')->name('series.put');
    });
});

Route::group(['prefix' => 'temporadas'], function () {
    Route::get('/{temporada}/episodios', 'EpisodiosController@index')->name('episodios.index');

    Route::group(['middleware' => 'autenticador'], function () {
        Route::post('/{temporada}/episodios/assistir', 'EpisodiosController@assistir')->name('episodios.assistir');
    });
});


Route::get('/entrar', 'EntrarController@index')->name('entrar.index');
Route::post('/entrar', 'EntrarController@entrar')->name('entrar.entrar');

Route::get('/registrar', 'RegistroController@create')->name('registro.create');
Route::post('/registrar', 'RegistroController@store')->name('registro.store');

Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
