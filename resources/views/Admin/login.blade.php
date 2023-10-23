<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập Timoto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('assets/clients/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/clients/css/style.css')}}">
</head>
<body class="bg-rentalcard-in">

    <div class="row justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-center bg-rentalcard rounnded">
                        <img src="{{asset('assets\clients\images\logotimotopj.png')}}" height="87px" width="150px" 
                        class="rounded img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                    </div>
                    <h2 class="card-title d-flex justify-content-center">Timoto - Administrator</h2>
                </div>
                <div class="card-body">
                    @if(Session::has('error'))  
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form action="{{ route('admin.loginad') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label word-bg">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label word-bg">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" id="password" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary bg-rentalcard">Đăng nhập</button>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex justify-content-center mb-1"><h5>Nếu bạn chưa có tài khoản</h5></div>
                    <div class="d-flex justify-content-center"> 
                        <div class="col-lg-5 btn btn-primary bg-rentalcard m-3"><a href="{{route('register')}}" class="btn text-light">Đăng Ký</a></div> 
                        
                        <div class="col-lg-5 btn btn-danger bg-rentalcard m-3"><a href="{{route('home')}}" class="btn text-light">Quay lại</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>