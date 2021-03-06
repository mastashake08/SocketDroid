<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
    //
    public function upload(Request $request){
      $fn = str_random(25);
      $path = $request->audio->storeAs('audio', "{$fn}.3gp");
      $user = \App\Device::where('phone',$request->phone)->first()->user;
      $user->notify(new \App\Notifications\FileUploaded($fn));

    }

    public function download($filename){
      $url = public_path('storage/audio/'.$filename);

      return response()->file($url);
    }
}
