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
}
