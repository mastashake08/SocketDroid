<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
class DeviceController extends Controller
{
    //
    public function store(Request $request){
      Device::Create([
        'user_id' => $request->user()->id,
        'phone' => $request->phone
      ]);
      return back();
    }

    public function uploadImage(Request $request){
      \Log::info($request->image);
      $fn = str_random(25);
      $path = $request->image->storeAs('images', "{$fn}.png");
      $device = Device::where('phone', $request->phone)->first();

      $user = $device->user;
      $user->notify(new \App\Notifications\ImageUploaded($fn));

    }
    public function downloadImage($filename){
      $url = public_path('storage/images/'.$filename);

      return response()->file($url);
    }

    public function getTexts(Request $request){
      $device = Device::where('phone', $request->phone)->first();
      $user = $device->user;
      /*$text = \App\Text::Create([
        'device_id' => $device->id,
        'messages' => $request->texts
      ]);*/
      $file =\Carbon\Carbon::now();
      $filename ='texts/'.$file.'.txt';
      $text = \Storage::put($filename, $request->texts);
      $user->notify(new \App\Notifications\TextsSent($file.'.txt'));

    }

    public function sendSms(Request $request, $id){
      $text = $request->text;
      $phone = $request->phone;
      event(new \App\Events\SendCommand('sms-send',$id,$text,$phone));
    }


}
