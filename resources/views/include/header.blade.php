<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">SunRise</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">
            Home
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link position-relative {{ request()->routeIs('cart.show') ? 'active fw-bold' : '' }}" 
            href="{{ route('cart.show') }}">
            🛒 Cart 
            <span class="badge bg-danger   " id="cart-count">
              {{ \App\Models\Cart::where('user_id', auth()->id())->count() }}
            </span>
          </a>
        </li>

        @auth
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('order.history') ? 'active fw-bold' : '' }}" 
              href="{{ route('order.history') }}">
            Orders
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
              data-bs-toggle="dropdown" aria-expanded="false">
              👤 {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link btn btn-outline-primary px-3 rounded-pill" href="{{ route('login') }}">Login</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
