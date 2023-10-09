<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/5644bf12f0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('assets/clients/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/clients/css/style.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    @yield('css') 
    <style>
        
       
      </style>
</head>
<body>
    @include('clients.blocks.header')
    <main class="pt-5">

        <div class="container-flex pt-5 bg-rentalcard-in">
            <div class="row pt-5">

                {{-- <div class="col-xl-2 col-md-0 col-sm-12">
                    <aside>
                        @section('sidebar')
                            @include('clients.blocks.sidebar')
                        @show
                    </aside>
                </div> --}}

                <div class="col-xl-12 col-md-12 col-sm-12">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>
        
        
    </main>
    @include('clients.blocks.footer')
    <script src="{{asset('assets/clients/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/clients/js/custom.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('js')
    @stack('scripts')
</body>
</html>