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
Route::post('/send-push/{id}','DeviceController@sendPush');
Route::post('/sms-send/{id}', 'DeviceController@sendSms');
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
Route::post('/post-texts', 'DeviceController@getTexts');
Route::get('/how-it-works',function(){
  return view('about');
});
Route::resource('/texts','TextController');
Route::get("download-texts/{id}",'TextController@show');
Route::get("privacy",function(){
  return view('privacy');
});
Route::get('/users', function(){
  return \App\User::all();
});
Route::get('/activate',function(){
  return view('activate');
})->middleware(['auth','subscribed']);
Route::post('/add-device','AuthCodeController@register');
Route::post('/activate', 'AuthCodeController@activate')->middleware('auth');
Route::get('auth-codes',function(){
  return \App\AuthCode::all();
});
Route::post('/update-billing','StripeController@updateBilling');
Route::get('billing',function(){
  return view('billing');
})->middleware('auth');
Route::get('pricing',function(){
  return view('pricing');
});
