@extends('layouts.master')

@section('title')
  iMerch Shopping Cart
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-sm-8 col-md-6">
            <h1>Checkout</h1>
            <h4>Your Total: ${{ $total }}</h4>

         <form action="{{ route('checkout') }}" method="post" id="payment-form">
                <div class="d-flex flex-column">
                    <div class="col-xs-12 flex-grow-1">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" class="form-control" name="address" required>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="card-name">Card Holder Name</label>
                            <input type="text" id="card-name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                      <label for="card-element">
                        Credit or debit card
                      </label>
                      <div id="card-element" style="width:100%;" class="form-control">
                        <!-- A Stripe Element will be inserted here. -->
                      </div>

                      <!-- Used to display form errors. -->
                      <div id="card-errors" role="alert"></div>
                    </div>
            <!--      <div class="col-xs-12">
                        <div class="form-group">
                            <label for="card-number">Credit Card Number</label>
                            <input type="text" id="card-number" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="d-flex justify-content-between">
                            <div class="col-xs-6 mr-1">
                                <div class="form-group">
                                    <label for="card-expiry-month">Expiration Month</label>
                                    <input type="text" id="card-expiry-month" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="card-expiry-year">Expiration Year</label>
                                    <input type="text" id="card-expiry-year" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="card-cvc">CVC</label>
                            <input type="text" id="card-cvc" class="form-control" required>
                        </div>
                    </div> -->
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success">Buy now</button>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://js.stripe.com/v3/"></script>
  <script src="{{ URL::to('js/checkout.js') }}"></script>
@endsection
