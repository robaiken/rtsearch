<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/rt', 'PodcastController@index');

Route::get('/rt/api/topic/{query}', 'ApiController@topic');

Route::get('/rt/api/guests/{guests}', 'ApiController@guests');

Route::get('/design', function(){
    return view('sandbox');
});

Route::get('/all', function(){
  $s = new \App\Search();
    return $s->all();
});

Route::get('/process', function(){
    $p = new \App\PodcastProcessor();
    $p->addNewPodcasts();
});