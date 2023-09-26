<nav class="navbar navbar-expand-lg navbar-dark bg-rentalcard-in py-4 shadow fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href=""><img src="{{ asset('assets/clients/images/logotimotopj.png') }}" height="87px" width="150px" class="rounded img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('home')}}">Trang chủ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Giới thiệu</a>
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
          <li class="nav-item">
              <a class="nav-link" href="{{route('product')}}">Sản phẩm</a>
          </li>
        
          <li class="nav-item">
              <a class="nav-link" href="{{route('post-add')}}">Thêm sản phẩm</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('users.index')}}">Danh sách User</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{route('rental.index')}}">Danh sách Xe thuê</a>
          </li>
        </ul>
        <div>
          <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle avatar-image-sm"> 
        </div> 
        <div class="mb-4">
           <li class="nav-item dropdown">
            <a class="nav-link word-white dropdown-toggle mr-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ auth()->user()->fullname }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger container-flex" type="submit">Đăng xuất</button>
              </form></li>
              {{-- <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
            </ul>
          </li>
        </div>
         

        
        
      </div>
    </div>
  </nav>