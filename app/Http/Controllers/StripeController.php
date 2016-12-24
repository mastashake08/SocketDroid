<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    //
    public function updateBilling(Request $request){
      $user = $request->user();
      //$user->newSubscription('main', 'socket-droid')->create($request->stripeToken);
      $user->subscription('main')->cancel();
      return redirect('/activate');
    }

}
