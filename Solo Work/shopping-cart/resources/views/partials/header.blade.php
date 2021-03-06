<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="{{ route('product.index') }}">
      <!-- keeping logo width/height ratio same as original image -->
      <img src="{{ asset('logo/iMerch-green-fusia.png') }}" width="103.75" height="50" class="d-inline-block align-top" alt="JF Web Consulting Logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ route('product.shoppingCart') }}">
            <i class="fas fa-shopping-cart"></i> Shopping Cart
            <span class="badge badge-secondary">{{ Session::has('cart')
                                    ? Session::get('cart')->totalQty
                                    : '' }}
            </span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i>
User Management</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @if(Auth::check())
            <a class="dropdown-item" href="{{ route('user.profile') }}">User Profile</a>
            <a class="dropdown-item" href="{{route('user.logout')}}">Logout</a>

          @else
            <a class="dropdown-item" href="{{ route('user.signup') }}">Sign up</a>
            <a class="dropdown-item" href="{{ route('user.signin') }}">Sign in</a>
          @endif
        </div>
      </li>
    </ul>
  </div>
</nav>
