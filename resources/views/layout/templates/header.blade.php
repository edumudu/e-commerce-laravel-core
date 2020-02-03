<header>
  <nav class="navbar">
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
          <div class="form-group col m10">
            <input class="form-field" id="search" name="search_prod" required>
            <label for="search">Faça uma pesquisa :)</label>
          </div>
          <div class="form-group m2">
            <input class="btn" type="submit" name="search" value="Buscar">
          </div>
        </div>
      </form>
    </div>

    <div class="col s3 m3">
      <ul class="user-menu list-inline">
        <li class="dropdown">
          <a class="dropdown-toggle">
            <i class="fas fa-user-circle"></i>
          </a>
          <ul class="dropdown-menu">
            <li class="dropdown-item">
              <a href="login"><i class="fas fa-sign-in-alt"></i> Logar</a>
            </li>
            <li class="dropdown-item">
              <a href="register"><i class="fas fa-user-plus"></i> Cadastrar-se</a>
            </li>
          </ul>
        </li>
        <li><a class="dropdown-toggle">
          <i class="far fa-heart"></i>
        </a></li>
        <li><a class="dropdown-toggle">
          <a class="relative" href="  ">
            <i class="fas fa-shopping-cart"></i>
            <span class="count-notification">2</span>
          </a>
        </a></li>
      </ul>
    </div>
  </div> 
</header>