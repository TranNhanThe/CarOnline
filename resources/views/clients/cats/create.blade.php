@extends('layouts.client')
{{-- @section('title')
    {{$title}}
@endsection --}}

@section('content')
<div class="container">
    <h2>Create Cat</h2>
    <form action="/create" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="name">Cat Name:</label>
        <input type="text" name="cat_name" id="cat_name" required>

        <label for="image">Cat Image:</label>
        <input type="file" name="image[]" id="image" accept="image/*" multiple>

        <button type="submit">Create Cat</button>
    </form>
</div>
    @endsection