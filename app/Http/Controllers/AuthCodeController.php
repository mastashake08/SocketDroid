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
      $user = $request->user();
      if($user->subscribed('main')){
        if($user->subscribed('socket-droid')){
          $user->subscription('socket-droid')->incrementQuantity();
        }
        else{
          $user->newSubscription('socket-droid', 'socket-droid');
        }
      }
      //middleware takes care of case where user isn't subscribed and has more than 1 device already registered

        $device = \App\Device::Create([
          'user_id' => $request->user()->id,
          'phone' => $auth->uuid
        ]);
        event(new \App\Events\ActivatedDevice($device));

            return redirect('/home');
    }
}
