<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title> @yield('title') | {{ config('app.COMPANY') }} </title>
<meta name="author" content="Eduardo Wesley">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!--favicon-->
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

<!--fonts-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
<link rel="dns-prefetch" href="//fonts.gstatic.com">

<!--CSS-->
<link href="{{ asset('css/myBootcss.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/helpers.css') }}" rel="stylesheet">
 