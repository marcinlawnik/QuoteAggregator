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

//Website routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('fetch', ['uses' => 'ScrapeController@scrape']);

//API routes
Route::group(['prefix' => 'api'], function(){
    //Random quote

    //Specific quote
});
