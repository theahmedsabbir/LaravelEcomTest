
  {{-- <div class="wrapper"> --}}
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand text-primary text-left" href="{{ route('index') }}">Laravel Ecommerce</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">

            {{-- @if (Auth::check())           --}}
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('index') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('products') }}">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('contact') }}">Contact</a>
              </li>
              <li class="nav-item">

                <!-- search start -->

                <form action="{{ route('search') }}" method="GET" class="form-inline my-2 my-lg-0 nav-search ml-3">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search Products" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                  </div>        
                </form>

                <!-- search  end -->
              </li>
          </ul>

          

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <li class="nav-item">
              <a href="{{ route('cart.index') }}" class="nav-link mr-1">
                <i class="fa fa-shopping-cart cart-icon"></i> 
                <sup><span class="badge badge-danger" id="totalItems">
                  {{ App\Models\Cart::totalItems() }}
                </span></sup>
              </a>
            </li>
            @guest         
            
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">

              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <img src="{{App\Helpers\ImageHelper::getUserImage(Auth::user()->id)}}" class="img rounded-circle mr-2" width="25">
                {{ Auth::user()->first_name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                {{ __('Dashboard') }}
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                </a>
                

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
            </div>
          </li>
          @endguest
        </ul>

        </div>
      </div>
    </nav>
  {{-- </div> --}}