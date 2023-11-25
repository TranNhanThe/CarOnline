@extends('layouts.kclient')
@section('title')
    {{ $title }}
@endsection

@section('content')
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
    <div class="container">
        <span class="word-ash-normal">Trang chủ -</span> <span class="word-ash-normal">Xe thuê -</span> <span
            class="word-ash">{{ $rentalcar->car_name }}</span>


        <div class="row">
            <div class="col-6">
                <h1 class="my-3 word-ash">{{ $rentalcar->car_name }}</h1>
            </div>
            <div class="col-6   word-ash"> {{-- tim and share --}}

            </div>
        </div>
        <div class="row">
            {{-- infocar --}}
            <div class="col-md-8">

                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($rental_image as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->link) }}"
                                    class="d-block w-100 cover rounded object-slide" alt="Ảnh {{ $key + 1 }}">
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
                </div> {{-- end slide show --}}

                <h3 class="my-3 word-ash">Mô tả tổng quan</h3>

                <div class="row bg-rentalcard rounded m-1 mb-4 p-4">
                    <div class="col">
                        <h6><span class="word-white">Model: </span><span class="word-ash"> {{ $model->name }}</span></h6>
                        <h6><span class="word-white">Hãng: </span><span class="word-ash"> {{ $make->name }}</span></h6>
                        <h6><span class="word-white">Dòng xe: </span><span class="word-ash"> {{ $bodytype->name }}</span>
                        </h6>
                        <h6><span class="word-white">Dẫn động: </span><span class="word-ash">
                                {{ $drivetrain->name }}</span>
                        </h6>
                        <h6><span class="word-white">Động cơ: </span><span class="word-ash">
                                {{ $rentalcar->engine }}</span></h6>
                        <h6><span class="word-white">Hộp số: </span><span class="word-ash">
                                {{ $transmission->name }}</span></h6>
                    </div>
                    <div class="col">
                        <h6><span class="word-white">Loại nhiên liệu: </span><span class="word-ash">
                                {{ $fuel->name }}</span></h6>
                        <h6><span class="word-white">Màu ngoại thất: </span><span class="word-ash">
                                {{ $rentalcar->exterior_color }}</span></h6>
                        <h6><span class="word-white">Màu nội thất: </span><span class="word-ash">
                                {{ $rentalcar->interior_color }}</span></h6>
                        <h6><span class="word-white">Số ghế ngồi: </span><span class="word-ash">
                                {{ $rentalcar->seat }}</span></h6>
                        <h6><span class="word-white">Biển kiểm soát: </span><span class="word-ash">
                                {{ $rentalcar->bsx }}</span></h6>
                        <h6><span class="word-white">VIN: </span><span class="word-ash"> {{ $rentalcar->vin }}</span></h6>
                    </div>
                </div> {{-- end tổng quan --}}

                <div class="row">
                    {{-- ghế --}}
                    <div class="col-md-4 col-sm-2">
                        <div class="rounded bg-rentalcard text-white pt-3" style="width: auto; height: auto;">
                            <div class="d-flex align-items-center justify-content-center"><img
                                    src="{{ asset('assets\clients\images\rental.png') }}" width="50px" alt="">
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <h5>Đã thuê {{ $rentalcar->rented }} lần</h5>
                            </div>
                        </div>
                    </div>
                    {{-- hộp số --}}
                    <div class="col-md-4 col-sm-2">
                        <div class="rounded bg-rentalcard text-white pt-3" style="width: auto; height: auto;">
                            <div class="d-flex align-items-center justify-content-center"><img
                                    src="{{ asset('assets\clients\images\driver.png') }}" width="50px" alt="">
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <h6>
                                    @if ($rentalcar->driver == 1)
                                        Có kèm tài xế
                                    @elseif ($rentalcar->driver == 0)
                                        Không kèm tài xế
                                    @else
                                        Liên hệ
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                    {{-- nhiên liệu --}}
                    <div class="col-md-4 col-sm-2">
                        <div class="rounded bg-rentalcard text-white pt-3" style="width: auto; height: auto">
                            <div class="d-flex align-items-center justify-content-center"><img
                                    src="{{ asset('assets\clients\images\accident.png') }}" width="50px" alt="">
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <h5>
                                    @if ($rentalcar->no_accident == 1)
                                        Chưa từng va chạm
                                    @elseif ($rentalcar->no_accident == 0)
                                        Từng va chạm
                                    @else
                                        Không xác định
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end detail --}}
                @foreach ($utilities as $key => $utilities)
                @endforeach
                <h3 class="my-3 word-ash">Tính năng</h3>
                <div class="row bg-rentalcard rounded m-1 mb-4 p-4">
                    <div class="col word-ash">
                        <h3 class="word-white">An Toàn</h3>

                        <p>
                            @if ($utilities->lop_du_phong == 1)
                                <img src="{{ asset('assets\clients\images\lop.png') }}" width="25px" alt=""> Lốp
                                dự phòng
                            @endif
                        </p>

                        <P>
                            @if ($utilities->camera_lui == 1)
                                <img src="{{ asset('assets\clients\images\camback.png') }}" width="25px" alt="">
                                Camera Lùi
                            @endif
                        </P>

                        <p>
                            @if ($utilities->camera_cap_le == 1)
                                <img src="{{ asset('assets\clients\images\pack.png') }}" width="25px" alt="">
                                Camera Cập Lề
                            @endif
                        </p>

                        <p>
                            @if ($utilities->cam_bien_va_cham == 1)
                                <img src="{{ asset('assets\clients\images\accident.png') }}" width="25px"
                                    alt=""> Cảm Biến Va Chạm
                            @endif
                        </p>

                        <P>
                            @if ($utilities->cam_bien_lop == 1)
                                <img src="{{ asset('assets\clients\images\apsuat.png') }}" width="25px"
                                    alt=""> Cảm Biến Lốp
                            @endif
                        </P>

                        <p>
                            @if ($utilities->camera_360 == 1)
                                <img src="{{ asset('assets\clients\images\360.png') }}" width="25px" alt="">
                                Camera 360
                            @endif
                        </p>

                        <p>
                            @if ($utilities->tui_khi_an_toan == 1)
                                <img src="{{ asset('assets\clients\images\airbag.png') }}" width="25px"
                                    alt=""> Túi Khí An Toàn
                            @endif
                        </p>



                        <p>
                            @if ($utilities->canh_bao_toc_do == 1)
                                <img src="{{ asset('assets\clients\images\speed.png') }}" width="25px" alt="">
                                Cảnh báo tốc độ
                            @endif
                        </p>
                    </div>

                    <div class="col word-ash">
                        <h3 class="word-white">Tiện Nghi</h3>

                        <P>
                            @if ($utilities->Bluetooth == 1)
                                <img src="{{ asset('assets\clients\images\bluetooth.png') }}" width="25px"
                                    alt=""> Bluetooth
                            @endif
                        </P>

                        <P>
                            @if ($utilities->dinh_vi_gps == 1)
                                <img src="{{ asset('assets\clients\images\gps.png') }}" width="25px" alt="">
                                Định vị GPS
                            @endif
                        </P>

                        <P>
                            @if ($utilities->etc == 1)
                                <img src="{{ asset('assets\clients\images\etc.png') }}" width="25px" alt="">
                                ETC
                            @endif
                        </P>

                        <p>
                            @if ($utilities->cua_so_troi == 1)
                                <img src="{{ asset('assets\clients\images\cuasotroi.png') }}" width="25px"
                                    alt=""> Cửa Sổ Trời
                            @endif
                        </p>

                        <p>
                            @if ($utilities->khe_cam_usb == 1)
                                <img src="{{ asset('assets\clients\images\usb.png') }}" width="25px" alt="">
                                Khe Cắm USB
                            @endif
                        </p>

                        <p>
                            @if ($utilities->camera_hanh_trinh == 1)
                                <img src="{{ asset('assets\clients\images\camera.png') }}" width="25px"
                                    alt=""> Camera Hành Trình
                            @endif
                        </p>

                        <p>
                            @if ($utilities->ghe_tre_em == 1)
                                <img src="{{ asset('assets\clients\images\child.png') }}" width="25px" alt="">
                                Ghế Trẻ em
                            @endif
                        </p>

                        <p>
                            @if ($utilities->man_hinh_dvd == 1)
                                <img src="{{ asset('assets\clients\images\dvd.png') }}" width="25px" alt="">
                                Màn Hình DVD
                            @endif
                        </p>

                        <p>
                            @if ($utilities->ban_do == 1)
                                <img src="{{ asset('assets\clients\images\map.png') }}" width="25px" alt="">
                                Bản Đồ
                            @endif
                        </p>
                    </div>
                </div>
                {{-- end tính năng --}}
                <h3 class="my-3 word-ash">Mô tả của chủ xe</h3>

                <div class="bg-rentalcard rounded word-white m-1 mb-4 p-4">
                    <p id="content">
                        {{ $rentalcar->mota }}
                    </p><button class="btn btn-success bg-rentalcard" id="readMore">Đọc tiếp</button>
                </div>
                {{-- end mô tả chủ xe --}}
                <h3 class="my-3 word-ash">Giấy tờ thuê xe</h3>

                <div class="bg-rentalcard rounded word-white p-4">
                    <h5>Chọn một trong hai hình thức</h5>
                    <p>
                        <i class='fa fa-address-card-o'></i> Giấy phép lái xe hạng B1 trở lên và căn cước công dân. <br>
                        <i class='fa fa-drivers-license'></i> Giấy phép lái xe hạng B1 trở lên và Passport.
                    </p>
                </div>
                {{-- end mô tả chủ xe --}}
                <hr>
                <h3 class="my-3 word-ash">Đánh giá</h3>

                <div class="bg-rentalcard rounded p-4">
                    {{-- ---------------loop here-------------- --}}
                    @if (!empty($sub_rental))
                        @foreach ($sub_rental as $key => $sub)
                        @if ($sub->finish == 1)
                            <div class="row bg-white p-1 m-1    rounded border border-3 border-warning">
                                {{-- ----------------avatar------------------ --}}
                                @php
                                    // use App\Models\Users;
                                    // $user_said = Users::where('id', $sub_rental->id_user)->get();
                                    $user_said = \App\Models\Users::where('id', $sub->id_user)->get();
                                @endphp
                                <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                    <div>
                                        


                                            @foreach ($user_said as $key => $said)
                                                <img src="{{ asset('storage/' . $said->avatar) }}" alt="Avatar"
                                                    class="rounded-circle avatar-image">

                                    </div>
                                </div>
                                {{-- --------------------star------------------- --}}
                                <div class="col-9 col-sm-6 col-md-6 col-lg-8 col-xl-6 col-xxl-6">
                                    <h5 class="mt-1">{{ $said->fullname }}</h5>
                                            @endforeach

                        <h6>
                            <div>
                                @php
                                    $rating = $sub->userstar; // Đây là giá trị xếp hạng thực tế
                                    $fullStars = floor($rating); // Số sao đầy
                                    $halfStar = $rating - $fullStars >= 0.5; // Xem xét có hiển thị nửa sao không
                                @endphp
                                <div class="rating-e">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $fullStars)
                                            <span class="star">&#9733;</span>
                                        @elseif ($i == $fullStars + 1 && $halfStar)
                                            <span class="star-half">&#9734;</span>
                                        @else
                                            <span class="star">&#9734;</span>
                                        @endif
                                    @endfor
                                    <span class="word-white">{{ $users->user_star }}</span>
                                </div>
                            </div>
                        </h6>
                </div>
                <div class="t-a-r col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">{{ date('d-m-Y', strtotime($sub->updated_at)) }}</div>
                {{-- -------------------------comment----------------------- --}}
                <h5>{{ $sub->car_comment }}</h5>
            </div>
            @else
                
            @endif
            @endforeach

            @endif
        </div>

        <div class="row word-white">
            @foreach ($ad_rent as $key => $item)
                <div class="col-4">Ngày hết hạn: {{ date('d-m-Y', strtotime($item->expiration_date)) }}</div>
                <div class="col-4">Mã tin đăng: {{ $item->id }}</div>
                <div class="col-2">ID: {{ $rentalcar->id }}</div>
                <div class="col-2">Lượt xem: {{ $rentalcar->view_count }}</div>
            @endforeach
        </div>








    </div>
    {{-- end infocar --}}
    {{-- ------------------------------------------------------------------------------------ --}}
    {{-- info you --}}
    <div class="col-md-4">
        <div class="row container">
            <h4>
                <div>
                    @php
                        use App\Models\SubRental;
                        $averageCarStar = SubRental::where('id_car', $rentalcar->id)->avg('carstar');
                        $averageUserStar = SubRental::where('id_dealer', $users->id)->avg('userstar');
                        $carRater = SubRental::where('id_car', $rentalcar->id)->where('carstar', '!=', null)->count();
                        $userRater = SubRental::where('id_car', $rentalcar->id)->count();
                    @endphp
                    @php
                        $rating = $averageCarStar; // Đây là giá trị xếp hạng thực tế
                        $fullStars = floor($rating); // Số sao đầy
                        $halfStar = $rating - $fullStars >= 0.5; // Xem xét có hiển thị nửa sao không
                    @endphp
                    <div class="rating-e">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $fullStars)
                                <span class="star"><i class="fa fa-star"
                                        style="font-size:24px;color:yellow"></i></span>
                            @elseif ($i == $fullStars + 1 && $halfStar)
                                <span class="star-half"><i class="fa fa-star-half-full"
                                        style="font-size:24px;color:yellow"></i></span>
                            @else
                                <span class="star"><i class="fa fa-star-o"
                                        style="font-size:24px;color:yellow"></i></span>
                            @endif
                        @endfor
                        
                        <span class="word-white">{{ round($averageCarStar, 1) }}</span>
                        
                        {{-- @if (!empty($sub->carstar)) --}}
                            <h6 class="word-white">{{ $carRater }} đánh giá</h6>
                        {{-- @endif --}}
                        
                        
                    </div>
                </div>
                </h5>

                {{-- end rating --}}
                <h3 class="word-white">
                    @foreach ($ad_rent as $key => $item)
                        {{ number_format($item->price, 0, ',', '.') }}
                        <span style="font-size: medium">đồng/ngày</span>
                </h3>
                <p class="my-1 word-ash-normal"><i style="font-size: 20px" class='fa-solid fa-location-dot'></i>
                    {{ $rentalcar->location }}, {{ $province->name }}</p>
                @if ($item->expiration_date >= now() && $item->status == 1)
                    <div class="row">
                        <div class="col-2">
                            <h3><button title="Chia sẻ" class="btn" id="copy-button"><i
                                        class="fas fa-share heart-icon"></i></button></h3>
                        </div>
                        <div class="col">


                            {{-- -------------------------------- --}}
                            @if (Auth::check())
                                <form action="{{ route('favorite.toggle', $rentalcar->id) }}" method="POST">
                                    @csrf
                                    <button class="btn" type="submit">
                                        @if (Auth::user()->hasFavorite($rentalcar->id))
                                            <h4><i class='fa fa-heart word-rental-money' title="Bỏ yêu thích"></i>
                                            </h4>
                                        @else
                                            <h4><i class='fa fa-heart-o word-rental-money' title="Thêm vào yêu thích"></i>
                                            </h4>
                                        @endif
                                    </button>
                                </form>
                            @endif
                            {{-- ------------------------------------------ --}}

                        </div>

                        <div id="message" class="alert alert-info text-center msg" style="display: none;">
                        </div>
                    </div>
                @endif
                @endforeach


                <div class="bg-rentalcard rounded m-1 mb-4 p-2">
                    <p class="word-white">Chủ Xe Tư Nhân</p>

                    <div class="row">
                        <div class="col-3">
                            <div>
                                <img src="{{ asset('storage/' . $users->avatar) }}" alt="Avatar"
                                    class="rounded-circle avatar-image">
                            </div>
                        </div>
                        <div class="col-9 word-white">
                            <h5 class="mt-1">{{ $users->fullname }}</h5>
                            <h6>
                                <div>
                                    @php
                                        $rating = $averageUserStar; // Đây là giá trị xếp hạng thực tế
                                        $fullStars = floor($rating); // Số sao đầy
                                        $halfStar = $rating - $fullStars >= 0.5; // Xem xét có hiển thị nửa sao không
                                    @endphp
                                    <div class="rating-e">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullStars)
                                                <span class="star"><i class="fa fa-star"
                                                        style="font-size:24px;color:yellow"></i></span>
                                            @elseif ($i == $fullStars + 1 && $halfStar)
                                                <span class="star-half"><i class="fa fa-star-half-full"
                                                        style="font-size:24px;color:yellow"></i></span>
                                            @else
                                                <span class="star"><i class="fa fa-star-o"
                                                        style="font-size:24px;color:yellow"></i></span>
                                            @endif
                                        @endfor
                                        <span class="word-white">{{ $averageUserStar }}</span>
                                    </div>
                                </div>
                            </h6>


                        </div>
                    </div>

                    <h6 class="word-rental-money mid">{{ $users->email }}</h6>
                    <a href="#" class="word-ash" style="text-decoration-line:underline">
                        <a class="word-white-orange" href="{{ route('search', ['keywords' => $users->fullname]) }}">Các
                            tin đăng khác của {{ $users->fullname }}</a>

                    </a>

                    <div class="btn btn-primary bg-rentalcard-in mid">
                        <h6><i style="font-size: 25px" class='fas fa-phone-volume'></i>
                            {{ $users->phone }}
                        </h6>
                    </div>


                </div>
        </div>
        @foreach ($ad_rent as $key => $item)
            {{-- @if ($item->status == 1 || $item->expiration_date >= now()) --}}
            @if ($item->expiration_date >= now() && $item->status == 1)
                <div>



                    <form action="{{ route('rental.post-one') }}" method="POST">
                        @csrf
                        <div class="bg-rentalcard word-white rounded">
                            <h3 class="mid">Bảng tính tiền</h3>

                            <h3 class="mid word-rental-money">{{ number_format($item->price, 0, ',', '.') }}
                                <span class="px-1" style="font-size: medium"> đồng/ngày</span>
                            </h3>

                            <h3 class="mid word-rental-money" style="display:none" id="daily_price">
                                {{ $item->price }} <span class="px-1" style="font-size: medium">
                                    đồng/ngày</span></h3>

                            <h6 class="px-4"> Ngày nhận </h6>
                            <div class="px-4">
                                <input class="form-control" id="received_date" type="date" name="received_date">
                                @error('received_date')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <h6 class="px-4"> Ngày trả </h6>
                            <div class="px-4">
                                <input class="form-control" id="return_date" type="date" name="return_date">
                                @error('return_date')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <h5 class="px-4">Địa điểm giao / nhận xe</h5>
                            <div class="mid  p-2">
                                <p class="px-4 word-rental-money rounded p-2 w-100 bg-rentalcard-in" class="my-1"><i
                                        style="font-size: 20px" class='fa-solid fa-location-dot'></i>
                                    {{ $rentalcar->location }}, {{ $province->name }}</p>
                            </div>
                            {{-- <p class="px-4 word-rental-money p-2 w-100 bg-rentalcard-in" class="my-1"><i style="font-size: 20px" class='fa-solid fa-location-dot'></i> {{$rentalcar->location}}, {{$province->name}}</p> --}}

                            <h6 class="px-4"> Giao nhận </h6>
                            <div class="mid p-2">
                                <div class=" p-2 w-100 rounded bg-rentalcard-in ">
                                    <p>Giao nhận xe tận nơi trong bán kính <span class="word-rental-money">5km</span>.</p>
                                    <p>Phí giao nhận <span class="word-rental-money">Miễn phí</span>.</p>
                                </div>
                            </div>

                            <h6 class="px-4"> Phụ phí </h6>
                            <div class="mid p-2">
                                <div class=" p-2 w-100 rounded bg-rentalcard-in ">
                                    <p>Giới hạn quãng đường <span class="word-rental-money">500</span>km/ngày.</p>
                                    <p>Vượt quá mỗi 1 km: <span class="word-rental-money">4000</span>đ/km. (trả
                                        thêm cho chủ xe)</p>
                                </div>
                            </div>

                            <h6 class="px-4"> Chi tiết giá </h6>

                            <table>
                                <tr>
                                    <td class="px-4">{{ $model->name }}</td>

                                    <td class="px-4">{{ number_format($item->price, 0, ',', '.') }} vnđ/ngày
                                    </td>

                                </tr>
                                <tr>
                                    <td class="px-4">Phí dịch vụ</td>
                                    <td class="px-4">50.000 vnđ/ngày</td>
                                </tr>
                                <tr>
                                    <td class="px-4">Bảo hiểm</td>
                                    <td class="px-4">70.000 vnđ/ngày</td>
                                </tr>
                                <tr>
                                    <td class="px-4">Số ngày thuê</td>
                                    <td class="px-4">x <span class="word-rental-money" id="rent_days"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4">Tiền cọc 50% giá</td>
                                    <td class="px-4">{{ number_format($item->price / 2, 0, ',', '.') }} vnđ<span
                                            class="word-rental-money"></span></td>
                                </tr>
                            </table>

                            <hr>

                            <table>
                                <tr>
                                    <td class="px-4 mid">
                                        <h6>Tổng phí thuê xe</h6>
                                    </td>
                                    <input style="display: none" type="text" value="{{ $item->id }}"
                                        name="id_ad_rent" class="form-control">
                                    <input style="display: none" type="text" value="" id="syad"
                                        name="days" class="form-control">
                                    <input style="display: none" type="text" value="{{ $rentalcar->id_user }}"
                                        name="id_dealer" class="form-control">
                                    <input style="display: none" type="text" value="{{ $rentalcar->id }}"
                                        name="id_car" class="form-control">
                                    <input style="display: none" type="text" value="{{ $item->price / 2 }}"
                                        name="deposit" class="form-control">
                                    <input style="display: none" type="text" value="{{ $item->price / 2 }}"
                                        name="deposit" class="form-control">
                                    @if (auth()->user())
                                        <input style="display: none" class="form-control" name="renter"
                                            value="{{ auth()->user()->id }}" type="text">
                                    @endif

                                    <input type="text" style="display: none" class="bg-rentalcard" name="total"
                                        id="totalCredit">
                                    {{-- <input  type="text" value="{{ number_format(($item->price+(70000)+(50000))*(7), 0, ',', '.') }}" name="total" class="form-control" id="totalCredit"> --}}
                                    <td class="px-4">
                                        <h6><span id="totalshow" class="word-rental-money"></span><span>
                                                vnđ</span> </h6>
                                    </td>
                                </tr>
                            </table>
                            @if (!empty(auth()->user()))
                                @if ($rentalcar->id_user == auth()->user()->id)
                                @else
                                    <div class="row m-2">
                                        <button type="submit" title="Thanh toán" name="redirect"
                                            class="btn back-green mid"> Thanh toán bằng VNPay</button>

                                    </div>

                                    {{-- <div class="row m-2">
                                                <button class="btn mid back-green" name="pttt" value="canbo"
                                                    type="submit">Thanh toán dành cho cán bộ</button>
                                            </div> --}}
                                @endif
                            @else
                                <a class="my-2 btn text-search mid mx-2" href="">Thanh toán MOMO</a>

                                <a class=" btn text-search mid mx-2" name="redirect" href="">Thanh toán VNPAY</a>

                                <div class="row m-2">
                                    <button class="btn mid back-green" name="pttt" value="canbo"
                                        type="submit">Thanh toán dành cho cán bộ</button>
                                </div>
                            @endif



                            <br>


                        </div>
                    </form>
                </div>
            @elseif($item->rentaldays != 0 && !$item->expiration_date)
                {{-- <div><a class="back-green" href="">Đang chờ duyệt</a></div>  --}}
                <div class="bg-rentalcard word-info p-2 rounded">
                    <h2 class="mid"><i class='fa fa-clock'></i></h2>
                    <h3 class="mid">Đang chờ duyệt</h3>
                </div>
            @elseif(!$item->rentaldays)
                <div class="bg-rentalcard word-rental-money p-2 rounded">

                    <a class="btn btn-primary mid" href="{{ route('rental.ad-add', ['id' => $rentalcar->id]) }}">Đăng tin
                        xe này</a>
                </div>
            @elseif($item->rentaldays != 0 && !$item->expiration_date < now())
                <div class="bg-rentalcard word-rental-money p-2 rounded">
                    <h2 class="mid"><i class='fa fa-warning'></i>Tin đăng hết hạn</h2>
                    <a class="back-orange rounded mid"
                        href="{{ route('rental.ad-readd', ['id' => $rentalcar->id]) }}">Gia hạn</a>
                </div>
            @else
                <div class="bg-rentalcard word-rental-money p-2 rounded">
                    <h2 class="mid"><i class='fa fa-warning'></i></h2>
                    <h3 class="">Xe đã hết hạn, hoặc chủ xe đã dừng kinh doanh xe này!</h3>
                    {{-- <div class="mid">
                  @if (Auth::check())
                            <form action="{{ route('favorite.toggle', $rentalcar->id) }}" method="POST">
                              @csrf
                              <button class="btn" type="submit">
                                  @if (Auth::user()->hasFavorite($rentalcar->id))
                                  <button class="btn text-search">Hủy yêu thích</button>
                                  @endif 
                              </button>
                          </form>
                          @endif 
                </div> --}}
                </div>
            @endif
        @endforeach
    </div>
    {{-- end info you --}}
    </div>


    <div class="row container">
        <h2 class="my-3 word-ash">Có thể bạn quan tâm</h2>

        @foreach ($newrentalcarList as $key => $item)
            <div class="container mb-2  col-12 col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xxl-4">
                <div class="container">
                    <div class=" bg-rentalcard rounded-open">

                        <div class="row">

                            {{-- /////////////////////////////////image///////////////////////////// --}}
                            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12  col-xxl-12">

                                <div class="rounded-image-open container-flex">

                                    {{-- <img src="public/storage/{{$item->image_link}}" class="image cover object" id="{{$item->id}}"> --}}
                                    <a href="{{ route('rental.show', ['id' => $item->id]) }}"><img
                                            src="{{ asset('storage/' . $item->image_link) }}" class="image cover object"
                                            id="{{ $item->id }}"></a>

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

                            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xxl-12">
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
                                                    src="{{ asset('assets\clients\images\seat2.png') }}" width="30px"
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
                                                    src="{{ asset('assets\clients\images\fuel.png') }}" width="30px"
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
    </div>


    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const receivedDate = document.getElementById("received_date");
            const returnDate = document.getElementById("return_date");

            receivedDate.addEventListener("change", updateRentDays);
            returnDate.addEventListener("change", updateRentDays);

            function updateRentDays() {
                // Lấy giá trị ngày nhận và ngày trả
                const receivedDateValue = new Date(receivedDate.value);
                const returnDateValue = new Date(returnDate.value);
                // const now = now();
                // if (receivedDateValue < now) {
                //     alert("Ủa.");
                //     return;
                // }
                const now = Date.now();
                if (receivedDateValue < now) {
                    document.getElementById("received_date").value = Date.now();
                    alert("Ngày nhận không thể trước ngày hiện tại.");

                    return;
                }
                // Kiểm tra xem ngày nhận và ngày trả có hợp lệ không
                if (!receivedDateValue || !returnDateValue) {
                    return;
                }

                // Kiểm tra xem ngày trả có lớn hơn ngày nhận không

                if (returnDateValue <= receivedDateValue) {
                    alert("Ngày trả phải lớn hơn ngày nhận.");
                    document.getElementById("return_date").value = null;
                    return;
                }

                // Tính số ngày thuê
                const rentDays = (returnDateValue - receivedDateValue) / (1000 * 60 * 60 * 24);

                // Cập nhật số ngày thuê và tổng phí thuê xe
                const dailyPrice = parseFloat(document.getElementById("daily_price").textContent.replace(/[^\d.-]/g,
                    ''));
                document.getElementById("rent_days").textContent = rentDays;
                document.getElementById("syad").value = rentDays;
                const total = rentDays * calculateTotalPrice() + dailyPrice / 2;
                const totalshow = total.toLocaleString('vi-VN');
                document.getElementById("totalCredit").value = total;
                document.getElementById("totalshow").textContent = totalshow;
            }

            function calculateTotalPrice() {
                // Thêm mã tính giá thuê dựa vào ngày nhận và ngày trả ở đây
                // Ví dụ: Lấy giá từ trường input, tính phí dịch vụ và bảo hiểm, và trả về tổng giá
                const dailyPrice = parseFloat(document.getElementById("daily_price").textContent.replace(/[^\d.-]/g,
                    ''));
                const serviceFee = 50000;
                const insuranceFee = 70000;
                return (dailyPrice + serviceFee + insuranceFee);
            }
        });
    </script>

    <script>
        const contentElement = document.getElementById('content');
        const readMoreButton = document.getElementById('readMore');

        const maxWords = 45; // Số từ tối đa bạn muốn hiển thị ban đầu

        // Lấy nội dung ban đầu
        const initialContent = contentElement.textContent.trim().split(/\s+/);
        const initialWords = initialContent.slice(0, maxWords).join(' ');
        const remainingWords = initialContent.slice(maxWords).join(' ');

        contentElement.innerHTML =
            `${initialWords} <span id="dots">...</span><span id="more" style="display: none;">${remainingWords}</span>`;

        if (initialContent.length > maxWords) {
            readMoreButton.style.display = 'block';
        }

        readMoreButton.addEventListener('click', function() {
            const dots = document.getElementById('dots');
            const moreText = document.getElementById('more');

            if (dots.style.display === 'none') {
                dots.style.display = 'inline';
                readMoreButton.textContent = 'Hiện thêm';
                moreText.style.display = 'none';
            } else {
                dots.style.display = 'none';
                readMoreButton.textContent = 'Ẩn';
                moreText.style.display = 'inline';
            }
        });
    </script>
    <script>
        $(function() {
            $('#datepicker').datepicker();
        });
    </script>

    <script>
        // Lấy phần tử DOM cho nút "Copy" và phần tử để hiển thị thông báo
        const copyButton = document.getElementById('copy-button');
        const messageElement = document.getElementById('message');

        // Khởi tạo Clipboard.js
        const clipboard = new ClipboardJS(copyButton, {
            text: function() {
                // Trả về đường link hiện tại làm nội dung để sao chép
                return window.location.href;
            }
        });

        // Xử lý khi sao chép thành công
        clipboard.on('success', function(e) {
            messageElement.style.display = 'block';
            messageElement.innerText = 'Đã sao chép đường link vào clipboard.';
            e.clearSelection(); // Xóa lựa chọn để tránh hiển thị vùng được chọn.
        });

        // Xử lý khi sao chép thất bại
        clipboard.on('error', function() {
            messageElement.style.display = 'block';
            messageElement.innerText = 'Không thể sao chép đường link.';
        });
    </script>

@endsection
