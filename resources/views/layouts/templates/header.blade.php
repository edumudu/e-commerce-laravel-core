<header class="pink-glamuor white-text">
  <nav class="navbar no-box-shadow">
    <div class="container">
      <div class="navbar-wrapper">
          <a class="brand-logo" href="{{ route('site.home') }}">{{ config('app.COMPANY') }}</a>

          <ul class="hide-on-mobile-down">
            <li><a href="{{ route('site.home') }}">Home</a></li>
            <li><a href="{{ route('site.contact') }}">Contato</a></li>
            <li><a href="{{ route('site.about') }}">Sobre</a></li>
            <li><a href="{{ route('site.products') }}">Produtos</a></li>
          </ul>
      </div>
    </div>
  </nav>
  <div class="row">
    <div class="col s9 m9">
      <form>
        <div class="row">
          <div class="form-group col m10 white-text">
            <input class="form-field line white-text" id="search" name="search_prod" required>
            <label for="search">Faça uma pesquisa :)</label>
          </div>
          <div class="form-group m2">
            <input class="btn btn-primary" type="submit" name="search" value="Buscar">
          </div>
        </div>
      </form>
    </div>

    <div class="col s3 m3">
      <ul class="user-menu list-inline center">
        <li class="dropdown">
          <a class="dropdown-toggle">
            <i class="fas fa-user-circle"></i>
          </a>
          <ul class="dropdown-menu left dark-text">
            @guest
              <li class="dropdown-item"><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a></li>
              <li class="dropdown-item"><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> {{ __('Register') }}</a></li>
            @else
            <li class="dropdown-item">
              {{-- <a class="dropdown-toggle" href="#">{{ Auth::user()->name }}</a> --}}
              <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
            @endguest
          </ul>
        </li>
        <li><a class="dropdown-toggle" href="">
          <i class="far fa-heart"></i>
        </a></li>
        <li><a class="dropdown-toggle">
          <a class="notification" href="{{ route('site.cart') }}">
            <i class="fas fa-shopping-cart"></i>
            <span class="count-notification">2</span>
          </a>
        </a></li>
      </ul>
    </div>
  </div> 
</header>