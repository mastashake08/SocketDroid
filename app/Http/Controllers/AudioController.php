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
    }

    public function download($filename){
      $url = Storage::url("app/audio/{$filename}");
      return response()->file($url);
    }
}
