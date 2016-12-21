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
      $path = $request->image>storeAs('images', "{$fn}.png");
      $user = \App\User::all();
      $user->each(function($item, $key) use($fn){
        $item->notify(new \App\Notifications\ImageUploaded($fn));
      });
    }
    public function downloadImage($filename){
      $url = public_path('storage/images/'.$filename);

      return response()->file($url);
    }
}
