@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('content')
<h1 class="text-white">{{$title}}</h1>

<h4 class="my-1 word-ash">{{$rentalcar->car_name}}</h4>
@endsection