@extends('layouts.site')

@section('title', 'Home')

@section('scripts')
<script src="{{ asset('js/slider.js') }}"></script>
@endsection

@section('content')
  <section class="slider">

    <div class="sliders-wrapper flex">
      @foreach ($slides as $slide)
      <img class="responsive-img" src="{{ $slide->img }}" title="{{ $slide->name }}" alt="{{ $slide->name }}">
      @endforeach
    </div><!--sliders-wrapper-->

    <ol class="dots-wrapper flex">
      @foreach (range(1, count($slides)) as $i)
      <li class="dot"></li>
      @endforeach
    </ol><!--dots-wrapper-->

    <span class="arrow-left"><i class="fas fa-chevron-left"></i></span>
    <span class="arrow-right"><i class="fas fa-chevron-right"></i></span>

  </section><!--slider-->

  <section class="vitrine">
    <div class="container">
      <h1 class="title">Destaques</h1>
      <div class="row">

        @foreach($destaques as $destaque)
        <div class="col s12 m6 l4 flex-column hoverable box-product">
          <a href="{{  route('site.products.single', $destaque->ID)  }}">
            <img 
              class="responsive-img box-img" 
              src="{{ $destaque->img }}"
              alt="{{ $destaque->name }}"
              title="{{ $destaque->name }}"
            >
          </a>

          <div class="box-title">
            <a href="">{{ $destaque->name }}</a>
          </div>

          <div class="flex space-between align-middle">
            <span class="price">R$ {{ $destaque->preco }} </span>
            <a class="btn btn-shop" href="{{ route('site.products.single',  $destaque->ID) }}">Comprar</a>
          </div>

        </div><!--box-->
        @endforeach

      </div>
    </div><!--container-->
  </section><!--vitrine-->
@endsection