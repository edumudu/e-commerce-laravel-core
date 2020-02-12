<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.templates.dashboard.head')
    </head>
    <body>
        <header>
            @include('layouts.templates.dashboard.header')
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            @include('layouts.templates.dashboard.footer')
        </footer>

        <!--scripts-->
        @yield('scripts')
    </body>
</html>