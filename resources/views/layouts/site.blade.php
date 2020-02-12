<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('layouts.templates.head')
  </head>
  <body class="sticky-footer">

    @include('layouts.templates.header')

    <main>
      @yield('content')
    </main>

    <footer class="footer dark">
      @include('layouts.templates.footer')
    </footer>

    <!--script-->
    <script src="{{ asset('js/myBoot.js') }}"></script>

  </body>
</html>

