@extends('layouts.client')
@section('content')
    <h1>Sản Phẩm</h1>
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    {{-- <x-package-alert>Content </x-package-alert> --}}
    @push('scripts')
    <script>
        console.log('Push lan 2');
    </script>
    @endpush
@endsection

@section('sidebar')
    @parent
    <h3>product sidebar</h3>
@endsection

@section('title')
    {{$title}}
@endsection

@section('css')
  
    
@endsection

@section('js')
 
@endsection

@prepend('scripts')
<script>
    console.log('Push lan 1');
</script>
@endprepend