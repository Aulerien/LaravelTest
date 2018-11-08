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

Route::get('/hello',function(){
    return 'Hello World!';
});

Route::get('hello', 'Hello@index');

Route::get('/Accueil/Du-Site', 'Hello@show')->name('accueil');

Route::post('ajouter/article', 'Article@create');

Route::post('modifier/article/{idArticle}', 'Article@update');

Route::get('supprimer/{idArticle}', 'Article@delete')->name('suppression');

Route::post('envoyer_mail', 'MonMail@envoyer');

Route::post('tester/mail', 'verifier@tester')->name('verification');