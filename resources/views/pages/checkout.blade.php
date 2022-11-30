@extends('layouts.app')
@section('content')
@section('extra-css')
   <script src="https://js.stripe.com/v3/"></script>
@endsection
@include('includes.header', ['pageTitle' => 'Checkout'])
</div>
</div>
</div>
<div class="container">
   <div class="row py-4">
      <div class="col-md-4 order-md-2 mb-4">
         <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span
               class="badge badge-secondary badge-pill">{{ Cart::instance('default')->content()->count() }}</span>
         </h4>
         <ul class="list-group mb-3">
            @foreach ($cartContent as $item)
               <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                     <h6 class="my-0">{{ $item->name }}</h6>
                     <small
                        class="text-muted">{{ Str::limit($item->options->description, 20) }}</small>
                  </div>
                  <span class="text-muted">${{ $item->price }}</span>
               </li>
            @endforeach
            @if (session()->has('coupon'))
               <li class="list-group-item d-flex justify-content-between bg-light">
                  <div class="text-success">
                     <h6 class="my-0">Promo code</h6>
                     <small>{{ session()->get('coupon')['code'] }}</small>
                  </div>
                  <form action="{{ route('coupon.destroy') }}"
                     method="POST">
                     @method('delete')
                     @csrf
                     <button type="submit"
                        class="btn btn-outline-danger btn-sm">
                        <i class="fa fa-trash"
                           aria-hidden="true"></i></button>
                  </form>
                  <span class="text-success">-${{ session()->get('coupon')['discount'] }}</span>
               </li>
               <li class="list-group-item d-flex justify-content-between">
                  <span>SubTotal (USD)</span>
                  <strong>${{ $newSubtotal }}</strong>
               </li>
               <li class="list-group-item d-flex justify-content-between">
                  <span>Tax 13% (USD)</span>
                  <strong>${{ $newTax }}</strong>
               </li>
               <li class="list-group-item d-flex justify-content-between text-success">
                  <span>Total (USD)</span>
                  <strong>${{ $newTotal }}</strong>
               </li>
            @else
               <li class="list-group-item d-flex justify-content-between">
                  <span>SubTotal (USD)</span>
                  <strong>${{ Cart::subTotal() }}</strong>
               </li>
               <li class="list-group-item d-flex justify-content-between">
                  <span>Tax 13% (USD)</span>
                  <strong>${{ Cart::tax() }}</strong>
               </li>
               <li class="list-group-item d-flex justify-content-between text-info">
                  <span>Total (USD)</span>
                  <strong>${{ Cart::total() }}</strong>
               </li>
            @endif
         </ul>
         @if (!session()->has('coupon'))
            <form action="{{ route('coupon.store') }}"
               method="POST"
               class="card p-2">
               @csrf
               <div class="input-group">
                  <input type="text"
                     name="coupon_code"
                     class="form-control"
                     placeholder="Promo code">
                  <div class="input-group-append">
                     <button type="submit"
                        class="btn btn-primary">Redeem</button>
                  </div>
               </div>
            </form>
         @endif
      </div>
      <!--Message section  -->
      @include('partials.alert-message')
      <div class="col-md-8 order-md-1">
         <h4 class="mb-3 display-5 text-bold text-center ">Payment Information</h4>
         <!-- credit cart form  -->
         <div class="form-group">
            <form action="{{ route('checkout.store') }}"
               method="post"
               id="payment-form">
               @csrf
               <div class="mb-3">
                  <label for="email">Email</label>
                  @if (Auth()->user())
                     <input type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        placeholder="you@example.com"
                        value="{{ Auth()->user()->email }}"
                        readonly>
                  @else
                     <input type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        placeholder="you@example.com"
                        value="{{ old('email') }}">
                  @endif
                  <div class="invalid-feedback">
                     Please enter a valid email address for shipping updates.
                  </div>
               </div>
               <div class="mb-3">
                  <label for="full_name">Full name</label>
                  <div class="input-group">
                     <input type="text"
                        class="form-control"
                        name="fullName"
                        id="full_name"
                        placeholder="fullname"
                        value="{{ Auth()->user()->name ?? old('name') }}">
                     <div class="invalid-feedback"
                        style="width: 100%;">
                        Your full Name is required.
                     </div>
                  </div>
               </div>
               <div class="mb-3">
                  <label for="adress">Address</label>
                  <input type="text"
                     class="form-control"
                     name="adress"
                     id="adress"
                     placeholder="1234 Main St"
                     value="{{ Auth()->user()->adress ?? old('adress') }}">
                  <div class="invalid-feedback">
                     Please enter your shipping address.
                  </div>
               </div>
               <div class="mb-3">
                  <label for="city">City</label>
                  <input type="text"
                     class="form-control"
                     id="city"
                     name="city"
                     placeholder="1234 Main St"
                     value="{{ Auth()->user()->city ?? old('city') }}">
                  <div class="invalid-feedback">
                     Please enter your shipping City.
                  </div>
               </div>
               <div class="mb-3">
                  <label for="name_on_card">Name On Credit Card</label>
                  <input type="text"
                     class="form-control"
                     id="name_on_card"
                     name="nameOnCart"
                     placeholder="1234 Main St">
                  <div class="invalid-feedback">
                     Please enter your shipping Name On Credit Card.
                  </div>
               </div>
               <label for="card-element">
                  Credit or debit card
               </label>
               <div id="card-element"
                  class="py-4">
                  <!-- A Stripe Element will be inserted here. -->
               </div>
               <!-- Used to display form errors. -->
               <div id="card-errors"
                  role="alert"></div>
               <!-- </div> -->
               <!-- <button>Submit Payment</button> -->
               <div class="row mb-md-5">
                  <div class="col">
                     <button type="submit"
                        id="ckeckoutbtn"
                        class="btn btn-lg btn-primary btn-block ">PURCHASE
                        ${{ $newTotal }}</button>
                  </div>
               </div>
            </form>
         </div>
         <!--end credit cart form  -->
      </div>
   </div>
</div>
@section('extra-js')
   <script>
      (function() {
         // Create a Stripe client.
         var stripe = Stripe(
            "pk_test_51HQWrSGN5UThjgnLjDjy8ahOs3k4ObsrsjYp7dDrpWi5fvMPTlf1mYDkn3IdRuegIMtlp469OAvjLe7WKk5d03p000avpU8spJ"
         );

         // Create an instance of Elements.
         var elements = stripe.elements();

         // Custom styling can be passed to options when creating an Element.
         // (Note that this demo uses a wider set of styles than the guide below.)
         var style = {
            base: {
               color: '#32325d',
               fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
               fontSmoothing: 'antialiased',
               fontSize: '16px',
               '::placeholder': {
                  color: '#aab7c4'
               }
            },
            invalid: {
               color: '#fa755a',
               iconColor: '#fa755a'
            }
         };

         // Create an instance of the card Element.
         var card = elements.create('card', {
            style: style
         });

         // Add an instance of the card Element into the `card-element` <div>.
         card.mount('#card-element');
         // Handle real-time validation errors from the card Element.
         card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
               displayError.textContent = event.error.message;
            } else {
               displayError.textContent = '';
            }
         });

         // Handle form submission.
         var form = document.getElementById('payment-form');
         form.addEventListener('submit', function(event) {
            event.preventDefault();

            //disa requiredbled ckeckout btn
            document.getElementById('ckeckoutbtn').disabled = true;

            let options = {
               full_name: document.getElementById('full_name').value,
               email: document.getElementById('email').value,
               name: document.getElementById('name_on_card').value,
               adress: document.getElementById('adress').value,
               adress_city: document.getElementById('city').value,

            }
            stripe.createToken(card, options).then(function(result) {
               if (result.error) {
                  // Inform the user if there was an error.
                  var errorElement = document.getElementById('card-errors');
                  errorElement.textContent = result.error.message;

                  //enabled ckeckout btn
                  document.getElementById('ckeckoutbtn').disabled = false;

               } else {
                  // Send the token to your server.
                  stripeTokenHandler(result.token);
               }
            });
         });
         // Submit the form with the token ID.
         function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
         }
      })();
   </script>
@endsection
@endsection
