{{-- <h1>404 PAGE NOT FOUND</h1>
<img src="{{ asset('assets\clients\images\ongkhiengda.png') }}" alt="">
<div class="col-lg-5 btn btn-danger bg-rentalcard m-3"><a href="{{route('home')}}" class="btn text-light">Quay lại</a></div> --}}
@extends('layouts.kclient')
@section('content')
@if (session('msg'))
    <div class="alert alert-{{session('type')}}">
        {{session('msg')}}
    </div>
@endif

<H1 class="d-flex justify-content-center word-rental-money">404 - Page not found</H1>
<div class="d-flex justify-content-center rounded">
    <img class="rounded" src="{{ asset('assets\clients\images\ongkhiengda.png') }}" width="30%" alt="">
    
      
      <div class=" middle btn btn-danger bg-rentalcard mt-5"><a href="{{route('home')}}" class="btn text-light">Quay lại trang chủ</a></div>
      
      <div class="bottom"><audio autoplay controls>
        <source  src="{{ asset('assets\clients\audio\sisyphus.mp3') }}" type="audio/mpeg">
      </audio></div>
     
</div>


@endsection