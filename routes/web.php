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

Route::get('/series', 'SeriesController@index')->name('series.index');
Route::get('/series/criar', 'SeriesController@create')->name('series.create');
Route::post('/series/criar', 'SeriesController@store')->name('series.store');
Route::delete('/series/{id}', 'SeriesController@destroy')->name('series.delete');
Route::post('/series/{id}/editaNome', 'SeriesController@put')->name('series.put');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index')->name('temporadas.index');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index')->name('episodios.index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')->name('episodios.assistir');
