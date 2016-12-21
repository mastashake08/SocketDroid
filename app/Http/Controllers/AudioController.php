<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudioController extends Controller
{
    //
    public function upload(Request $request){
      $fn = str_random(25);
      $path = $request->audio->storeAs('audio', "{$fn}.3gp");
    }
}
