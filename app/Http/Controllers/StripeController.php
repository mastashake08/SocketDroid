<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    //
    public function updateBilling(Request $request){
      $user = $request->user();
      $user->newSubscription('socket-droid', 'monthly')->create($request->stripeToken);
    }
    
}
