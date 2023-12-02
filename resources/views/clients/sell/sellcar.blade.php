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
        <span class="word-ash-normal">Trang chủ -</span> <span class="word-ash-normal">Xe bán -</span> <span
            class="word-ash">{{ $sellcar->car_name }}</span>


        <div class="row">
            <div class="col-6">
                <h1 class="my-3 word-ash">{{ $sellcar->car_name }}</h1>
            </div>
            <div class="col-6   word-ash"> {{-- tim and share --}}

            </div>
        </div>
        <div class="row">
            {{-- infocar --}}
            <div class="col-md-8">

                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($sell_image as $key => $image)
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
                                {{ $sellcar->engine }}</span></h6>
                        <h6><span class="word-white">Hộp số: </span><span class="word-ash">
                                {{ $transmission->name }}</span></h6>
                    </div>
                    <div class="col">
                        <h6><span class="word-white">Loại nhiên liệu: </span><span class="word-ash">
                                {{ $fuel->name }}</span></h6>
                        <h6><span class="word-white">Màu ngoại thất: </span><span class="word-ash">
                                {{ $sellcar->exterior_color }}</span></h6>
                        <h6><span class="word-white">Màu nội thất: </span><span class="word-ash">
                                {{ $sellcar->interior_color }}</span></h6>
                        <h6><span class="word-white">Số ghế ngồi: </span><span class="word-ash">
                                {{ $sellcar->seat }}</span></h6>
                        <h6><span class="word-white">Biển kiểm soát: </span><span class="word-ash">
                                {{ $sellcar->bsx }}</span></h6>
                        <h6><span class="word-white">VIN: </span><span class="word-ash"> {{ $sellcar->vin }}</span></h6>
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
                                <h5>Đã thuê {{ $sellcar->rented }} lần</h5>
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
                                    @if ($sellcar->driver == 1)
                                        Có kèm tài xế
                                    @elseif ($sellcar->driver == 0)
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
                                    @if ($sellcar->no_accident == 1)
                                        Chưa từng va chạm
                                    @elseif ($sellcar->no_accident == 0)
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
            @foreach ($sell_utilities as $key => $utilities)
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
                        {{ $sellcar->mota }}
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
                
        <div class="row word-white">
           
        </div>








    </div>
    {{-- end infocar --}}
    {{-- ------------------------------------------------------------------------------------ --}}
    {{-- info you --}}
    <div class="col-md-4">
        <div class="row container">
            <h4>
                
            </h4>

                {{-- end rating --}}
                <h3 class="word-white">
                        {{ number_format($sellcar->price, 0, ',', '.') }}
                        <span style="font-size: medium">đồng/ngày</span>
                </h3>
                <p class="my-1 word-ash-normal"><i style="font-size: 20px" class='fa-solid fa-location-dot'></i>
                    {{ $sellcar->location }}, {{ $province->name }}</p>
                

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
                                {{-- <div>
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
                                </div> --}}
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
       
    </div>
    {{-- end info you --}}
    </div>


    <div class="row container">
        <h2 class="my-3 word-ash">Có thể bạn quan tâm</h2>

        @foreach ($newsellcarList as $key => $item)
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
                                                {{ number_format($item->price, 0, ',', '.') }} Đồng</p>
                                        @endif
                                        <p class="my-1 word-ash-normal"><i style="font-size: 20px"
                                                class='fa-solid fa-location-dot'></i> {{ $item->location }},
                                            {{ $item->province_name }}</p>

                                    </div>

                                    <div class="col-md-4 col-sm-4  ">

                                        
                                        {{-- đã thuê n lần --}}

                                        
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
