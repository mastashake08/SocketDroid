<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    //
    public function updateBilling(Request $request){
      $user = $request->user();
      $user->newSubscription('main', 'free')->create($request->stripeToken);
      return redirect('/activate');
    }

}
