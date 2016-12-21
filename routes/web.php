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
Route::get('/command/{command}', function($command){
  event(new \App\Events\SendCommand($command));
});
Route::get('/response',function(){
  event(new \App\Events\SendResponse());
});
Route::post('/audio-upload','AudioController@upload');
Route::get('/download/{filename}','AudioController@download');

Auth::routes();

Route::get('/home', 'HomeController@index');
