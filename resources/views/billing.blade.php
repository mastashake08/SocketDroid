@extends('layouts.app')

@section('content')
<
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Billing Information</div>

                <div class="panel-body">
                  In order to use SocketDroid on more than one device please
                  update your billing information
                  <br>
                  <form action="/update-billing" method="POST">
                    @if(auth()->user()->card_brand != null)
                    Current card on file: {{auth()->user()->card_brand}} {{auth()->user()->card_last_four}}
                    <br>
                    @endif
                    {{ csrf_field() }}
                    <script
                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                      data-key="{{env('STRIPE_KEY')}}"
                      data-name="SocketDroid"
                      data-description="Your card details will be saved, but you will not be charged until a new device is added."
                      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                      data-locale="auto"
                      data-label="Update Billing Info">
                    </script>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
