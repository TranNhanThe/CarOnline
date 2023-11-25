<nav class="navbar navbar-expand-lg navbar-dark bg-rentalcard-in shadow fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href=""><img src="{{ asset('assets/clients/images/logotimotopj.png') }}"
                height="87px" width="150px"
                class="rounded img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
                </li>

                {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li> --}}

                {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li> --}}
                {{-- <li class="nav-item">
              <a class="nav-link" href="{{route('users.index')}}">Danh sách User</a>
          </li> --}}

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rental.index') }}">Danh sách Xe thuê</a>
                </li>

                @if (!empty(auth()->user()))
                    <li class="nav-item dropdown">
                        <a class="nav-link word-ash dropdown-toggle mr-3" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Quản lý
                        </a>
                        <ul class="dropdown-menu bg-rentalcard" aria-labelledby="navbarDropdown">
                        <li class="nav-item">
                            <a href="{{ route('rental.credit') }}" class="mid word-white-orange"><i class='fa fa-money'></i>&nbsp;Thêm Credit</a>
                        </li>                   
                        <hr>
                        <li class="">
                          <a class="word-white-orange mid" href="{{ route('favorite') }}">
                              <i class='fa fa-heart'></i>&nbsp; Yêu thích
                          </a>
                      </li>
                      <hr>
                      <li>
                        <a class="word-white-orange mid" href="{{ route('users.userinfo', ['id' => auth()->user()->id]) }}">
                            <i class='fa fa-user'></i>&nbsp; Thông tin cá nhân
                        </a>
                    </li>
                        </ul>
                    </li>

                    
                @endif
                @if (!empty(auth()->user()))
                    <li class="nav-item dropdown">
                        <a class="nav-link word-ash dropdown-toggle mr-3" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kênh cho thuê của bạn
                        </a>
                        <ul class="dropdown-menu bg-rentalcard" aria-labelledby="navbarDropdown">
                          <li class="nav-item ">
                            <a href="{{ route('rental.add') }}" class="mid word-white-orange"><i class='fa fa-plus'></i>&nbsp;Thêm xe thuê</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a href="{{ route('rental.yoretaca') }}" class="mid word-white-orange"><i class='fa fa-car'></i>&nbsp;Kho xe của tôi</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a href="{{ route('rental.yodealer') }}" class="mid word-white-orange"><i class='fa fa-send-o'></i>&nbsp;Yêu Cầu Thuê</a>
                        </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                    <a href="{{ route('rental.yorental') }}" class="nav-link">Xe bạn đang thuê</a>
                </li>
                @endif
                
            </ul>
            @if (empty(auth()->user()))
                <div>
                    <a href="{{ route('login') }}" class="btn bg-rentalcard word-ash m-1">Đăng nhập</a>
                </div>
                <div>
                    <a href="{{ route('register') }}" class="btn bg-rentalcard word-ash m-1">Đăng ký</a>
                </div>
            @endif
            @if (!empty(auth()->user()))
                {{-- <div>
            <img src="{{ asset('assets\clients\images\coin.png') }}"  width="30px" alt="" > 
            </div> --}}
                <div class="px-1 pt-3 mx-3">
                    <h5 class="word-ash "><img src="{{ asset('assets\clients\images\coin.png') }}" class=""
                            title="Credit" width="30px" alt=""> {{ auth()->user()->credit }}</h5>
                </div>


                <div>
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar"
                        class="rounded-circle avatar-image-sm">

                </div>
                <div class="mb-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link word-ash dropdown-toggle mr-3" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->fullname }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" role="search">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn nav-item dropdown word-black" type="submit"><i
                                            class='fa fa-sign-out'></i> Đăng xuất</button>
                                </form>
                            </li>


                        </ul>
            @endif
                        
            {{-- <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> --}}

            </li>
        </div>




    </div>
    </div>
</nav>
