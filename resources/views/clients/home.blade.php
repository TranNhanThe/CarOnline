    @extends('layouts.kclient')
    @section('content')
        @if (session('msg'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('msg') }}
            </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="display-4 word-white"><b>Tìm xe ôtô vừa ý một cách thật dễ dàng!</b></div>
                    <br>
                    <hr>
                    <div class="word-ash word-lg">"Timoto.com là thị trường xe ôtô kỹ thuật số hàng đầu
                        giúp kết nối các chủ xe và khách hàng tiềm năng."</div>
                </div>
                {{-- tách' --}}
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('assets\clients\images\bronco.png') }}"
                                    alt="First slide">
                            </div>
                            <div class="carousel-item ">
                                <img class="d-block w-100" src="{{ asset('assets\clients\images\mache.png') }}"
                                    alt="Second slide">
                            </div>
                        </div>
                    </div>
                    {{-- <img src="{{ asset('assets\clients\images\bronco.png') }}" width="100%" alt=""> --}}
                </div>
            </div>
            {{-- ----------------------------------Quote out----------------------------------- --}}

            <div>
                <button class="btn btn-danger">Mua Xe</button>
                <button class="btn btn-primary">Thuê Xe</button>
            </div>
            <br>
            {{-- ----------------------------------Các nút----------------------------------- --}}
            {{-- action="{{ route('search') }}" --}}

            <div class="text-bg">
                <form id="searchForm" action="{{ route('search') }}" method="GET">
                    <div class="row">
                        <h3><i class='fa fa-search'></i> Tìm xe thuê</h3>
                    </div>

                    <div class="row">

                        <div class="col-md-2 col-sm-12">
                            <input class="form-control bg-rentalcard word-white" value="{{ request()->keywords }}"
                                type="text" id="keyword" placeholder="Từ khóa" name="keywords">
                        </div>
                        <div class="col-md-2 col-sm-12">

                            <select class="form-select bg-rentalcard word-white" id="id_make" name="id_make">
                                <option value=""><i class='fas fa-car-alt'></i>Mọi Hãng</option>
                                @if (!empty(getAllMake()))
                                    @foreach (getAllMake() as $item)
                                        <option
                                            value="{{ $item->id }}"{{ request()->id_make == $item->id ? 'selected' : false }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                @endif
                                <!-- Thêm các hãng xe khác vào đây -->
                            </select>
                        </div>
                        {{-- style="display: none;" --}}
                        <div class="col-md-2 col-sm-12" id="modelField">

                            <select class="form-select bg-rentalcard word-white" id="id_model" name="id_model">
                                <option value=""><i class='fas fa-car-alt'></i>Mọi Model</option>
                                {{-- @if (!empty(getAllModels()))
                            @foreach (getAllModels() as $item)
                                <option value="{{$item->id}}"{{request()->id_model==$item->id?
                                    'selected':false}}>{{$item->name}}</option>                           
                            @endforeach
                        @endif --}}
                                <!-- Thêm các hãng xe khác vào đây -->
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-12">

                            <select class="form-select bg-rentalcard word-white" id="bodytype" name="id_bodytype">
                                <option value=""><i class='fas fa-car-alt'></i>Mọi Dòng xe</option>
                                @if (!empty(getAllBodytype()))
                                    @foreach (getAllBodytype() as $item)
                                        <option
                                            value="{{ $item->id }}"{{ request()->id_bodytype == $item->id ? 'selected' : false }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                @endif
                                <!-- Thêm các hãng xe khác vào đây -->
                            </select>

                        </div>
                        <div class="col-md-2 col-sm-12">
                            <select class="form-select bg-rentalcard word-white" id="province" name="id_province">
                                <option value=""><i class='fas fa-car-alt'></i>Trên cả Nước</option>
                                @if (!empty(getAllProvince()))
                                    @foreach (getAllProvince() as $item)
                                        <option
                                            value="{{ $item->id }}"{{ request()->id_province == $item->id ? 'selected' : false }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                @endif
                                <!-- Thêm các hãng xe khác vào đây -->
                            </select>

                        </div>
                        <div class="col-md-2 col-sm-12">
                            <button class="btn text-search" width="100%" type="submit">Tìm kiếm</button>
                        </div>

                    </div>

                </form>
            </div>
            <br>
            {{-- ---------------------------------------end search------------------------------------------- --}}

            <h2 class="word-white">Các dòng xe phổ biến</h2>
            <div class="row d-flex justify-content-center">
                <div class="col-6 col-md-2 wrap rounded">
                    <a href="search?id_bodytype=1">
                        <img src="assets\clients\images\sedan.svg" width="100%" alt="">
                        <div class="word-ash d-flex justify-content-center">
                            <h5>Sedan</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 wrap rounded">
                    <a href="search?id_bodytype=2">
                        <img src="assets\clients\images\suv.svg" width="100%" alt="">
                        <div class="word-ash d-flex justify-content-center">
                            <h5>Suv</h5>
                        </div>
                    </a>

                </div>
                <div class="col-6 col-md-2 wrap rounded">
                    <a href="search?id_bodytype=3">
                        <img src="assets\clients\images\wagon.svg" width="100%" alt="">
                        <div class="word-ash d-flex justify-content-center">
                            <h5>Wagon</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 wrap rounded">
                    <a href="search?id_bodytype=4">
                        <img src="assets\clients\images\crossover.svg" width="100%" alt="">
                        <div class="word-ash d-flex justify-content-center">
                            <h5>Crossover</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 wrap rounded">
                    <a href="search?id_bodytype=5">
                        <img src="assets\clients\images\coupe.svg" width="100%" alt="">
                        <div class="word-ash d-flex justify-content-center">
                            <h5>Coupe</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 wrap rounded">
                    <a href="search?id_bodytype=6">
                        <img src="assets\clients\images\pickup.svg" width="100%" alt="">
                        <div class="word-ash d-flex justify-content-center">
                            <h5>Pickup</h5>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-2 wrap rounded">
                    <a href="search?id_bodytype=7">
                        <img src="assets\clients\images\sport.svg" width="100%" alt="">
                        <div class="word-ash d-flex justify-content-center">
                            <h5>Sport Coupe</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 wrap rounded">
                    <a href="search?id_bodytype=8">
                        <img src="assets\clients\images\compact.svg" width="100%" alt="">
                        <div class="word-ash d-flex justify-content-center">
                            <h5>Compact</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 wrap rounded">
                    <a href="search?id_bodytype=9">
                        <img src="assets\clients\images\convertible.svg" width="100%" alt="">
                        <div class="word-ash d-flex justify-content-center">
                            <h5>Convertible</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-2 wrap roundedwrap rounded">
                    <a href="search?id_bodytype=10">
                        <img src="assets\clients\images\mpv.svg" width="100%" alt="">
                        <div class="word-ash d-flex justify-content-center">
                            <h5>Family MVP</h5>
                        </div>
                    </a>
                </div>
            </div>

            <br>
            {{-- --------------------------------end bodytype-------------------------------------- --}}

            <h2 class="word-white">Gợi ý hàng đầu</h2>
            <div class="row">
                @if (!empty($rentalcarList))
                    @foreach ($rentalcarList as $key => $item)
                        {{-- <div class="container mb-3 col-12 col-md-12 col-lg-12 col-xl-4 "> --}}
                        <div class="container mb-3 col-12 col-lg-6 col-md-12 col-sm-12 col-xxl-6">
                            <div class="container">

                                <div class=" bg-rentalcard rounded-open">

                                    <div class="row">

                                        {{-- /////////////////////////////////image///////////////////////////// --}}
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xxl-12">

                                            <div class="rounded-image-open container-flex">

                                                {{-- <img src="public/storage/{{$item->image_link}}" class="image cover object" id="{{$item->id}}"> --}}
                                                <a href="{{ route('rental.show', ['id' => $item->id]) }}"><img
                                                        src="storage/{{ $item->image_link }}" class="image cover object"
                                                        id="{{ $item->id }}"></a>

                                                <div class="middle" id="1{{ $item->id }}">
                                                    @if (Auth::check())
                                                        <form action="{{ route('favorite.toggle', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button class="btn" type="submit">
                                                                @if (Auth::user()->hasFavorite($item->id))
                                                                    <i class='fa fa-heart word-rental-money'
                                                                        title="Bỏ yêu thích" style="font-size: 30px"></i>
                                                                @else
                                                                    <i class='fa fa-heart-o word-rental-money'
                                                                        title="Thêm vào yêu thích"
                                                                        style="font-size: 30px"></i>
                                                                @endif
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>

                                                <div class="toptop" id="2{{ $item->id }}">

                                                    <div>

                                                        <img src="assets\clients\images\logotimotopj.png"
                                                            class="rounded img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                                            alt="">

                                                    </div>
                                                </div>
                                                {{-- assets\clients\images\kar.jpg --}}
                                                {{-- height="200px" width="auto" --}}
                                                {{-- {{$item->image_link}} --}}
                                            </div>
                                        </div>
                                        {{-- /////////////////////////////////image-end///////////////////////////// --}}

                                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xxl-12">
                                            <div class="row container">

                                                <div class="col-md-8 col-sm-8">
                                                    <p class="my-1 word-ash-normal">
                                                        {{ date('d-m-Y', strtotime($item->created_at)) }}</p>
                                                    <a href="{{ route('rental.show', ['id' => $item->id]) }}">
                                                        <h4 class="my-1 word-ash">{{ $item->car_name }}</h4>
                                                    </a>
                                                    <p class="my-1 word-rental-money">
                                                        {{ number_format($item->adprice, 0, ',', '.') }} Đồng/ngày</p>
                                                    <p class="my-1 word-ash-normal"><i style="font-size: 20px"
                                                            class='fa-solid fa-location-dot'></i> {{ $item->location }},
                                                        {{ $item->province_name }}</p>

                                                </div>

                                                <div class="col-md-4 col-sm-4  ">

                                                    <div class="d-flex align-items-center justify-content-center">

                                                        <img src="assets\clients\images\rental.png" class="pt-2"
                                                            width="30px" alt="">
                                                        <h3 class="word-ash-normal pt-3">: {{ $item->rented }}</h3>
                                                    </div>
                                                    {{-- đã thuê n lần --}}

                                                    {!! $item->driver == 0
                                                        ? '<button class="btn btn-danger btn-sm mt-3">Không kèm tài xế</button>'
                                                        : '<button class="btn btn-success btn-sm mt-3">Có kèm tài xế</button>' !!}
                                                </div>

                                            </div>

                                            <hr>

                                            <div class="row container hidden-on-sm pb-3">
                                                {{-- ghế --}}
                                                <div class="col-md-4 col-sm-2">
                                                    <div class="rounded bg-rentalcard-in text-white pt-3"
                                                        style="width: auto; height: auto;">
                                                        <div class="d-flex align-items-center justify-content-center"><img
                                                                src="assets\clients\images\seat2.png" width="30px"
                                                                alt=""></div>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <h5>{{ $item->seat }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- hộp số --}}
                                                <div class="col-md-4 col-sm-2">
                                                    <div class="rounded bg-rentalcard-in text-white pt-3"
                                                        style="width: auto; height: auto;">
                                                        <div class="d-flex align-items-center justify-content-center"><img
                                                                src="assets\clients\images\gearboxpro.png" width="30px"
                                                                alt=""></div>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <h6>{{ $item->transmission_name }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- nhiên liệu --}}
                                                <div class="col-md-4 col-sm-2">
                                                    <div class="rounded bg-rentalcard-in text-white pt-3"
                                                        style="width: auto; height: auto">
                                                        <div class="d-flex align-items-center justify-content-center"><img
                                                                src="assets\clients\images\fuel.png" width="30px"
                                                                alt=""></div>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <h5>{{ $item->fuel_name }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h1 class="word-white">Không có tiền</h1>
                @endif
            </div>

            {{-- --------------------------------------------end offer------------------------------ --}}
            
            <h2 class="word-white">Điều gì làm cho Timoto khác biệt?</h2>
            <hr><br>
            <div class="row word-white">

                <div class="col-md-5 col-sm-12">
                    <div class="row">
                        <div class="col-10 ">
                            <h4 class="d-flex justify-content-end">Danh sách hơn 5000 xe</h4>
                            <p class="d-flex t-a-r justify-content-end d-none d-sm-block">Số lượng xe nhiều hơn tất cả các
                                website khác gộp lại</p>
                        </div>
                        <div class="col-2">
                            <h4 class="word-rental-money"><i class='fa-solid fa-list-check'></i></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 ">
                            <h4 class="d-flex justify-content-end">Công cụ tìm kiếm mạnh mẽ</h4>
                            <p class="d-flex t-a-r justify-content-end d-none d-sm-block">Dễ dàng tìm thấy những chiếc xe
                                dành riêng cho bạn</p>
                        </div>
                        <div class="col-2">
                            <h4 class="word-rental-money"><i class='fa fa-flash'></i></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 ">
                            <h4 class="d-flex t-a-r justify-content-end">Cung cấp nguồn xe uy tín, minh bạch</h4>
                            <p class="d-flex t-a-r justify-content-end d-none d-sm-block">Thông tin chính xác, xe đúng chủ,
                                nguồn gốc rõ ràng, qua kiểm chứng</p>
                        </div>
                        <div class="col-2">
                            <h4 class="word-rental-money"><i class='fa fa-address-card'></i></h4>
                        </div>
                    </div>
                </div>

                <div class="col-2 hidden-on-sm">
                    <img src="{{ asset('assets\clients\images\bronback.png') }}" width="100%" alt="">
                    <img src="{{ asset('assets/clients/images/logotimotopj.png') }}" height="87px" width="150px"
                        class="rounded  img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                        alt="">

                </div>

                <div class="col-md-5 col-sm-12">
                    <div class="row">
                        <div class="col-2">
                            <h4 class="word-rental-money"><i class='fa fa-list'></i></h4>
                        </div>
                        <div class="col-10 ">
                            <h4 class="d-flex justify-content-start">Danh mục đa dạng</h4>
                            <p class="d-flex t-a-l justify-content-end d-none d-sm-block">Nhiều danh mục và được chia nhỏ
                                thành
                                các chi tiết như model, hãng, dòng, hộp số, truyền động,...</p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-2">
                            <h4 class="word-rental-money"><i class='fa fa-car'></i></h4>
                        </div>
                        <div class="col-10 ">
                            <h4 class="d-flex justify-content-start">Mật độ xe dày đặc</h4>
                            <p class="d-flex t-a-l justify-content-end d-none d-sm-block">Luôn sẵn có xe dịch vụ của Timoto
                                trên mọi tỉnh thành</p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-2">
                            <h4 class="word-rental-money"><i class="fas fa-headphones-alt"></i></h4>
                        </div>
                        <div class="col-10 ">
                            <h4 class="d-flex justify-content-start">Hỗ trợ trong quá trình sử dụng dịch vụ</h4>
                            <p class="d-flex t-a-l justify-content-end d-none d-sm-block">
                                Chuyến đi của bạn luôn được Timoto giám sát gián tiếp, nhằm hỗ trợ kịp thời
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <br>
            {{-- ----------------------------------end different------------------------------------------- --}}

            <h2 class="word-white">Xe mới nhất </h2>
            
            
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($newrentalcarList as $key => $item)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <div class="container mb-3 col-12 col-lg-12 col-md-12 col-sm-6 col-xxl-12">
                                <div class="container">
            
                                    <div class=" bg-rentalcard rounded-open">
            
                                        <div class="row">
            
                                            {{-- /////////////////////////////////image///////////////////////////// --}}
                                            <div class="col-md-12 col-lg-5 col-xl-5 col-sm-12 col-xxl-5">
            
                                                <div class="rounded-image-open container-flex">
            
                                                    {{-- <img src="public/storage/{{$item->image_link}}" class="image cover object" id="{{$item->id}}"> --}}
                                                    <a href="{{ route('rental.show', ['id' => $item->id]) }}"><img
                                                            src="{{ asset('storage/' . $item->image_link) }}"
                                                            class="image cover object" id="{{ $item->id }}"></a>
            
                                                    <div class="middle" id="1{{ $item->id }}">
                                                        @if (!empty(Auth::user()))
                                                            @if (Auth::user()->id != $item->id_user)
                                                                {{-- ------------------------ --}}
                                                                @if (Auth::check())
                                                                    <form action="{{ route('favorite.toggle', $item->id) }}"
                                                                        method="POST" id="favoriteForm">
                                                                        @csrf
                                                                        <button class="btn" type="submit">
                                                                            @if (Auth::user()->hasFavorite($item->id))
                                                                                <i class='fa fa-heart word-rental-money'
                                                                                    title="Bỏ yêu thích" style="font-size: 30px"></i>
                                                                            @else
                                                                                <i class='fa fa-heart-o word-rental-money'
                                                                                    title="Thêm vào yêu thích"
                                                                                    style="font-size: 30px"></i>
                                                                            @endif
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                                {{-- ---------------------------- --}}
                                                            @elseif(Auth::user()->id == $item->id_user && $item->status == 1 && $item->expdate >= now())
                                                                <a class="back-green rounded" href="">xe của bạn</a>
                                                            @elseif(Auth::user()->id == $item->id_user && $item->status == 1 && $item->rentaldays != 0 && !$item->expdate)
                                                                <a class="back-info rounded" href="">Đang chờ duyệt</a>
                                                            @elseif(Auth::user()->id == $item->id_user && $item->status == 1 && $item->rentaldays != 0 && $item->expdate < now())
                                                                <a class="back-orange rounded"
                                                                    href="{{ route('rental.ad-readd', ['id' => $item->id]) }}">Gia
                                                                    hạn</a>
                                                            @else
                                                                <a class="btn btn-primary"
                                                                    href="{{ route('rental.ad-add', ['id' => $item->id]) }}">Đăng tin
                                                                    xe
                                                                    này</a>
                                                            @endif
                                                        @endif
                                                    </div>
            
                                                    <div class="toptop" id="2{{ $item->id }}">
            
                                                        <div>
            
                                                            <img src=" {{ asset('assets\clients\images\logotimotopj.png') }} "
                                                                class="rounded img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                                                alt="">
            
                                                        </div>
                                                    </div>
            
                                                    <div class="topleft" id="3{{ $item->id }}">
            
                                                        <div>
                                                            @if (!empty($item->ad_status))
                                                                @if ($item->ad_status == 1)
                                                                    @if ($item->adtype == 1 && $item->expdate >= now())
                                                                        <p class=" saving word-white"><i class='fa fa-flash'></i> Tiết
                                                                            kiệm</p>
                                                                    @elseif($item->adtype == 2 && $item->expdate >= now())
                                                                        <p class=" silver word-white"><i class='fa fa-circle-o'></i>
                                                                            Cơ bản</p>
                                                                    @elseif($item->adtype == 3 && $item->expdate >= now())
                                                                        <p class=" gold word-white">
                                                                            <i class='fa fa-plus'></i> Plus
                                                                        </p>
                                                                    @elseif($item->adtype == 4 && $item->expdate >= now())
                                                                        <p class="platinum word-white"><i class='fa fa-star'></i>
                                                                            Premium</p>
                                                                    @else
                                                                        <p class="blood word-white"><i class='fa fa-warning'></i> Tin
                                                                            hết hạn</p>
                                                                    @endif
                                                                @else
                                                                @endif
                                                            @endif
            
            
                                                        </div>
                                                    </div>
                                                    {{-- assets\clients\images\kar.jpg --}}
                                                    {{-- height="200px" width="auto" --}}
                                                    {{-- {{$item->image_link}} --}}
                                                </div>
                                            </div>
                                            {{-- /////////////////////////////////image-end///////////////////////////// --}}
            
                                            <div class="col-md-12  col-lg-7 col-xl-7 col-sm-12 col-xxl-7">
                                                <div class="row container">
            
                                                    <div class="col-md-8 col-sm-8">
                                                        <p class="my-1 word-ash-normal">
                                                            {{ date('d-m-Y', strtotime($item->created_at)) }}</p>
                                                        <a href="{{ route('rental.show', ['id' => $item->id]) }}">
                                                            <h4 class="my-1 word-ash">{{ $item->car_name }}</h4>
                                                        </a>
                                                        @if (!empty($item->ad_status))
                                                            <p class="my-1 word-rental-money">
                                                                {{ number_format($item->adprice, 0, ',', '.') }} Đồng/ngày</p>
                                                        @endif
                                                        <p class="my-1 word-ash-normal"><i style="font-size: 20px"
                                                                class='fa-solid fa-location-dot'></i> {{ $item->location }},
                                                            {{ $item->province_name }}</p>
            
                                                    </div>
            
                                                    <div class="col-md-4 col-sm-4  ">
            
                                                        <div class="d-flex align-items-center justify-content-center">
            
                                                            <img src="{{ asset('assets\clients\images\rental.png') }}" class="pt-2"
                                                                width="30px" alt="">
                                                            <h3 class="word-ash-normal pt-3">: {{ $item->rented }}</h3>
                                                        </div>
                                                        {{-- đã thuê n lần --}}
            
                                                        {!! $item->driver == 0
                                                            ? '<button class="btn btn-danger btn-sm mt-3">Không kèm tài xế</button>'
                                                            : '<button class="btn btn-success btn-sm mt-3">Có kèm tài xế</button>' !!}
                                                    </div>
            
                                                </div>
            
                                                <hr>
            
                                                <div class="row container hidden-on-sm pb-3">
                                                    {{-- ghế --}}
                                                    <div class="col-md-4 col-sm-2">
                                                        <div class="rounded bg-rentalcard-in text-white pt-3"
                                                            style="width: auto; height: auto;">
                                                            <div class="d-flex align-items-center justify-content-center"><img
                                                                    src="{{ asset('assets\clients\images\seat2.png') }}"
                                                                    width="30px" alt=""></div>
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <h5>{{ $item->seat }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- hộp số --}}
                                                    <div class="col-md-4 col-sm-2">
                                                        <div class="rounded bg-rentalcard-in text-white pt-3"
                                                            style="width: auto; height: auto;">
                                                            <div class="d-flex align-items-center justify-content-center"><img
                                                                    src="{{ asset('assets\clients\images\gearboxpro.png') }}"
                                                                    width="30px" alt=""></div>
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <h6>{{ $item->transmission_name }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- nhiên liệu --}}
                                                    <div class="col-md-4 col-sm-2">
                                                        <div class="rounded bg-rentalcard-in text-white pt-3"
                                                            style="width: auto; height: auto">
                                                            <div class="d-flex align-items-center justify-content-center"><img
                                                                    src="{{ asset('assets\clients\images\fuel.png') }}"
                                                                    width="30px" alt=""></div>
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <h5>{{ $item->fuel_name }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
            
                                            </div>
                                        </div>
            
            
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div id="map"></div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Add markers or other map elements here...
    </script>
        <script src="https://code.jquery.com/jquery.min.js"></script>
        <script>
            $('#id_make').on('change', function() {
                var selectedValue = $(this).val();
                //alert(selectedValue);
                $.ajax({
                    url: 'selectmodel',
                    method: 'GET',
                    data: {
                        selectedValue: selectedValue
                    },
                    success: function(data) {
                        var district_sent = $('#id_model');
                        district_sent.empty();
                        $('#id_model').append($('<option>', {
                            value: 0,
                            text: "Tất cả Model"
                        }));
                        $.each(data, function(key, model) {
                            $('#id_model').append($('<option>', {
                                value: model
                                    .id{{ request()->id_model == $item->id ? 'selected' : false }},
                                text: model.name
                            }));
                        });
                    },
                    error: function() {
                        alert('Đã có lỗi xảy ra.');
                    }
                });
            });
        </script>

        <script>
            const containers = document.querySelectorAll('.container');

            // Lặp qua từng container và áp dụng hiệu ứng hover riêng lẻ
            containers.forEach((container) => {
                const image = container.querySelector('.image');
                const middle = container.querySelector('.middle');
                const toptop = container.querySelector('.toptop');

                container.addEventListener('mouseenter', () => {
                    image.style.opacity = '0.3';
                    middle.style.opacity = '1';
                    toptop.style.opacity = '1';

                });

                container.addEventListener('mouseleave', () => {
                    image.style.opacity = '1';
                    middle.style.opacity = '0';
                    toptop.style.opacity = '0';
                });
            });
        </script>
        <script>
            $(document).ready(function(){
              $('.your-slider').slick({
                slidesToShow: 3, /* Số lượng xe hiển thị trên mỗi slide */
                slidesToScroll: 1, /* Số lượng xe cuộn mỗi lần */
                autoplay: true, /* Tự động chạy slide */
                autoplaySpeed: 2000, /* Thời gian chuyển đổi giữa các slide (milliseconds) */
              });
            });
          </script>
          







    @endsection

    @section('title')
        {{ $title }}
    @endsection

    @section('css')
        {{-- <style>
                      img{
                        max-width: 100%;
                        height: auto;
                      }  

                    </style> --}}
    @endsection

    @section('js')
    @endsection
