@extends('layouts.master')

@section('title')
  iMerch Shopping Cart
@endsection

@section('slider')

<div id="carouselIndicators" class="carousel slide" data-ride="carousel">

  <div class="carousel-inner">
      <div class="container">
        @for ($i = 0; $i < 3; $i++)
            @if ($i == 0)
                <div class="carousel-item active">
            @else
                <div class="carousel-item">
            @endif
              <img class="d-block w-100 h-fold" src="{{ $products[$i]->imagePath }}" alt="{{ $products[$i]->title }}">
              <div class="carousel-caption d-none d-md-block">
                  <h5>{{ $products[$i]->title }}</h5>
                  <p>{{ $products[$i]->description }}</p>
            </div>
          </div>
        @endfor
      <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
  </div>
</div>
@endsection


@section('content')
  @if(Session::has('success'))
    <div class="row">
      <div class="col-sm-6">
        <div id="charge-message" class="alert alert-success">
          {{ Session::get('success') }}
        </div>
      </div>
    </div>
  @endif
    <h2 class="mt-5">Popular Books</h2>
    @foreach($products->chunk(4) as $productChunk)
        <div class="row d-md-flex mx-auto mt-2">
            @foreach($productChunk as $product)
              <div class="col-sm-6 col-lg-4 col-xl-3 my-3">
                <div class="card">
                  <img class="card-img-top img-responsive" src="{{ $product->imagePath }}" alt="Card image cap" >
                  <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <div class="clearfix">
                      <div class="float-left price">${{ $product->price }}</div>
                       <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-success float-right">Add to Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
    @endforeach
@endsection
