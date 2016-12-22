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
Route::get('/command/{command}/{id}', function($command,$id){
  event(new \App\Events\SendCommand($command,$id));
});
Route::get('/response',function(){
  event(new \App\Events\SendResponse());
});
Route::post('/audio-upload','AudioController@upload');
Route::post('/image-upload', 'DeviceController@uploadImage');
Route::get('/download/image/{filename}','DeviceController@downloadImage');
Route::get('/download/{filename}','AudioController@download');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/post-gps','GpsController@postGps');
Route::resource('gps','GpsController');
Route::resource('device','DeviceController');
Route::post('/post-battery', 'BatteryController@getBattery');
Route::get('/how-it-works',function(){
  return view('about');
});
