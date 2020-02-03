<footer class="footer dark">
  <div class="container">
    <div class="row">
      <div class="col s12 m6 l6 justify">
        <h3 class="title-little">Sobre nós</h3>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vestibulum eros nunc, vel ornare neque pharetra eu. Vivamus vel sapien dignissim, scelerisque est non, feugiat elit. Donec cursus a lorem sit amet facilisis. Aliquam et ipsum ligula.
        </p>
      </div>
      <div class="col s12 m6 l3">
        <h3 class="title-little">Paginas</h3>
        <ul class="list">
          <li><a href="{{ route('site.home') }}">Home</a></li>
          <li><a href="{{ route('site.contact') }}">Contato</a></li>
          <li><a href="{{ route('site.about') }}">Sobre</a></li>
        </ul>
      </div>
      <div class="col s12 m6 l3">
        <h3 class="title-little">Minha conta</h3>
        <ul class="list">
          <li><a href="#!">Meu perfil</a></li>
          <li><a href="#!">Meus pedidos</a></li>
          <li><a href="#!">Lista de desejo</a></li>
          <li><a href="#!">Carrinho</a></li>
        </ul>
      </div>
      <div class="col s12 m6 l3 hide-on-desktop">
        ola
      </div>
    </div>
  </div>
  <footer>
    <p> &copy; Todos os direitos reservados</p>
  </footer>
</footer>

<!--script-->
<script src="{{ asset('js/myBoot.js') }}"></script>

</body>
</html>