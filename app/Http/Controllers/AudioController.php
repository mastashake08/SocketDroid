<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudioController extends Controller
{
    //
    public function upload(Request $request){
      $path = $request->audio->store('audio');
    }
}
