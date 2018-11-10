@extends('layouts.master')

@section('title')
  iMerch Shopping Cart
@endsection

@section('content')
    @if(Session::has('cart'))
        <div class="d-flex justify-content-center mt-2">
            <div class="col-sm-8 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item d-flex align-items-center">
                            <strong>{{ $product['item']['title'] }}</strong>
                            <span class="badge badge-success mx-2">{{ $product['price'] }}</span>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownBtn">Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownBtn">
                                    <li class="dropdown-item"><a href="{{ route('product.reduceByOne', ['id'=>$product['item']['id']]) }}">Reduce by 1</a></li>
                                    <li class="dropdown-item"><a href="{{ route('product.remove', ['id'=>$product['item']['id']]) }}">Reduce All</a></li>
                                    <li class="dropdown-item"><a href="{{ route('product.moveToWishList', ['id'=>$product['item']['id']]) }}">Move To Wish List</a></li>
                                </ul>
                            </div>
                            <span class="badge badge-secondary ml-auto">{{ $product['qty'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="d-flex justify-content-center my-2">
            <div class="col-sm-6 col-sm-offset-3">
                <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-center">
            <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2>No Items in Cart</h2>
            </div>
        </div>
    @endif
    @if(Session::has('wish-list'))
      <h1>MY WISH LIST</h1>
        <div class="d-flex justify-content-center mt-2">
            <div class="col-sm-8 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($wishListProducts as $product)
                        <li class="list-group-item d-flex align-items-center">
                            <strong>{{ $product['item']['title'] }}</strong>
                            <span class="badge badge-success mx-2">{{ $product['price'] }}</span>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownBtn">Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownBtn">
                                    <li class="dropdown-item"><a href="{{ route('product.removeFromWishList', ['id'=>$product['item']['id']]) }}">Remove</a></li>
                                    <li class="dropdown-item"><a href="{{ route('product.moveToCart', ['id'=>$product['item']['id']]) }}">Move To Shopping Cart</a></li>
                                </ul>
                            </div>
                            <span class="badge badge-secondary ml-auto">{{ $product['qty'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="d-flex justify-content-center my-2">
            <div class="col-sm-6 col-sm-offset-3">
                <strong>Total: {{ $wishListTotalPrice }}</strong>
            </div>
        </div>
    @endif
@endsection
