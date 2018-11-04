
@extends('layouts.master')
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>User Profile</h1>
      <hr>    
      <h2>My Orders</h2>
      
      @foreach($orders as $order)
        <div class="card text-center">
          <ul class="list-group list-group-flush">
            @foreach($order->cart->items as $item)
              <li class="list-group-item">
                {{ $item['item']['title'] }} | {{ $item['qty'] }} Units
                <span class="badge">$ {{ $item['price'] }}</span>
              </li>
            @endforeach
          </ul>
          <div class="card-footer text-muted">
            <strong>Total Price: ${{ $order->cart->totalPrice }}</strong>  
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
