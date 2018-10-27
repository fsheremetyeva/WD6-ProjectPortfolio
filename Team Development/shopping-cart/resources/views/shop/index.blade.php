@extends('layouts.master')

@section('title')
  iMerch Shopping Cart
@endsection

@section('content')
    @foreach($products->chunk(3) as $productChunk)
        <div class="row">
            @foreach($productChunk as $product)
              <div class="col-sm-6 col-md-4">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top img-responsive" src="https://static.tvtropes.org/pmwiki/pub/images/harrypotterandthegobletoffire.jpg" alt="Card image cap" >
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <div class="clearfix">
                      <div class="float-left price">$56.00</div>
                       <a href="#" class="btn btn-success float-right">Add to Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
    @endforeach
@endsection
