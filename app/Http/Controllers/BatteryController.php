<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BatteryController extends Controller
{
    //
    public function getBattery(Request $request){
      event(new \App\Events\BatteryLevel($request->battery));
    }
}
