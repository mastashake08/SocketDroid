<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gps;
class GpsController extends Controller
{
    //
    public function postGps(Request $request){
      $gps = Gps::Create($request->all());
      event(new \App\Events\GpsCreated($gps));
      return $gps;
    }

    public function index(){
      return Gps::all();
    }
}
