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

Route::get('/', function() {return view('index');});
//----------------------------------------Code Testen-------------------------------------------------------------------
//Route::get('/test', "TestController@getViewTest");
//Route::delete('/test/{maId}', "TestController@deleteAzubi")->name('deleteAzubi');
//Route::post('/test/{maId}', "TestController@updateAzubi")->name('updateAzubi');
//---------------------------------------Azubi erstllen-----------------------------------------------------------------
Route::get('/azubi/new', "AzubiController@getViewNewAzubi");
Route::post('/azubi/new', "AzubiController@createNewAzubi")->name('createNewAzubi');
//----------------------------------------Alle Azubis-------------------------------------------------------------------
Route::get('/azubi/all', "AzubiController@getAzubi");
Route::delete('/azubi/{maId}', "AzubiController@deleteAzubi")->name('deleteAzubi');
Route::patch('/azubi/{maId}', "AzubiController@updateAzubi")->name('updateAzubi');
//-------------------------------------Bericht erstelllen---------------------------------------------------------------
Route::get('/bericht/new', "BerichteController@getViewNewBericht");
Route::post('/bericht/new', "BerichteController@createNewBericht")->name('createNewBericht');
//---------------------------------------Bericht Suchen-----------------------------------------------------------------
Route::get('/bericht/all', "BerichteController@getBericht");
Route::delete('/bericht/all/{maId}', "BerichteController@deleteBericht")->name('deleteBericht');
