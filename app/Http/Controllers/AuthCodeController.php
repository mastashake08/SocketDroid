<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuthCode;
class AuthCodeController extends Controller
{
    //
    public function register(Request $request){
      AuthCode::Create([
        'uuid' => $request->id,
        'code' => $request->code,
      ]);
    }

    public function activate(Request $request){
      $auth = AuthCode::where('code',$request->code)->first();
      $device = \App\Device::Create([
        'user_id' => $request->user()->id,
        'phone' => $auth->uuid
      ]);
      event(new \App\Events\ActivatedDevice($device));
    }
}
