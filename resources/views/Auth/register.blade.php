<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Ký Timoto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('assets/clients/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/clients/css/style.css')}}">
</head>
<body class="bg-rentalcard-in">
    
    
    <div class="row justify-content-center mt-5">
        {{-- <div class="col-lg-2 col-sm-12 rounded bg-rentalcard text-white pt-3" style="width: auto; height: auto">
            <div class="row">
            <div class="d-flex justify-content-center">
                <img src="assets\clients\images\logotimotopj.png" height="87px" width="150px" 
                class="rounded img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
            </div>
            
            <div class="btn bg-rentalcard-in word-ash mb-3">
                Đăng nhập
            </div>
            <div class="btn bg-rentalcard-in word-ash mb-3">
                Điều khoản
            </div>
            </div>
            
        </div> --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-center bg-rentalcard rounnded">
                        <img src="assets\clients\images\logotimotopj.png" height="87px" width="150px" 
                        class="rounded img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                    </div>
                    <h2 class="card-title d-flex justify-content-center">Đăng ký tài khoản</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Dữ liệu nhập vào không hợp lệ:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label word-bg">User's Name</label>
                            <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Họ và tên" value="{{old('fullname')}}" required>
                            @error('fullname')
                            <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label word-bg">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="{{old('email')}}" required>
                            @error('email')
                            <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label word-bg">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Ít nhất 9 ký tự, và một ký tự hoa" value="{{old('password')}}" id="password" required>
                            @error('password')
                            <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label word-bg">Só điện thoại</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Số điện thoại" value="{{old('phone')}}" required>
                            @error('phone')
                            <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cccd" class="form-label word-bg">Số căn cước công dân</label>
                            <input type="text" class="form-control" name="cccd" id="cccd" placeholder="Số căn cước" value="{{old('cccd')}}" required>
                            @error('cccd')
                            <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="avatar">Avatar:</label>
                            <input type="file" class="form-control" id="avatar" accept="image/*" name="avatar">
                        </div>
                     
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-success bg-rentalcard">Đăng ký</button>
                            </div>
                        </div>
                       
                    </form>
                        <div class="d-flex justify-content-center mb-1"><h5>Nếu bạn đã có tài khoản</h5></div>
                    <div class="d-flex justify-content-center"> 
                        <div class="col-lg-5 btn btn-primary bg-rentalcard m-3"><a href="{{route('login')}}" class="btn text-light">Đăng Nhập</a></div> 
                        
                        <div class="col-lg-5 btn btn-danger bg-rentalcard m-3"><a href="{{route('home')}}" class="btn text-light">Quay lại</a></div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>


</body>
</html>