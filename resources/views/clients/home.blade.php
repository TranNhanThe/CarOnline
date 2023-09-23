    @extends('layouts.client')
    @section('content')
    @if (session('msg'))
        <div class="alert alert-{{session('type')}}">
            {{session('msg')}}
        </div>
    @endif
    
                <h1>Trang chủ </h1>
                

                @env('test')
                    <p> mooi truong test</p>
                @endenv

                <x-alert type="info" :content="$message" data-icon="youtube" />
                
                {{-- <x-form-button /> --}}
                {{-- <x-forms.button />
                <x-inputs.button/> --}}

                <p><img src="https://sciencemeetsfood.org/wp-content/uploads/2019/01/cookie2-3.png" width="" alt=""></p>

                {{-- <p><a href="{{route('download-image').'?image=https://sciencemeetsfood.org/wp-content/uploads/2019/01/cookie2-3.png'}}" class="btn btn-primary">Download Ảnh</a></p> --}}

                <p><a href="{{route('download-image').'?image='.public_path('storage/hethon.jpg')}}"
                 class="btn btn-primary">Download Ảnh</a></p>
                 <p>Your User ID is: {{ auth()->user()->id }}</p>
                 <p><a href="{{route('download-doc').'?file='.public_path('storage/demo.pdf')}}"
                    class="btn btn-primary">Download tài liệu</a></p>
    @endsection

    @section('sidebar')
        @parent
        <h3>Home sidebar</h3>
    @endsection

    @section('title')
        {{$title}}
    @endsection

    @section('css')
                    <style>
                      img{
                        max-width: 100%;
                        height: auto;
                      }  

                    </style>
    @endsection

    @section('js')
  
    @endsection