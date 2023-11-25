@extends('layouts.kclient')
@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <div class="row">
        <div class="col-6">
            <h4 class="word-white mx-2"><span>{{ $title }}</span></h4>
        </div>
        <div class="col-6 t-a-r">
            <h4 class="mx-2"><a class="word-white-orange" href=""><i class='fa fa-history'></i> Lịch sử thuê</a> </h4>
        </div>
    </div>
    
    <hr>
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
                                        {{-- <a href="{{route('rental.show', ['id'=>$item->id])}}"><img src="{{ asset('storage/' . $item->image_link) }}" class="image cover object" id="{{$item->id}}"></a> --}}
                                        <a href="{{ route('rental.contract', ['id' => $item->sub_id]) }}"><img
                                                src="{{ asset('storage/' . $item->image_link) }}" class="image cover object"
                                                id="{{ $item->id }}"></a>
                                        
                                        <div class="middle" id="1{{ $item->id }}">
                                            @if (!empty(Auth::user()))
                                                @if (Auth::user()->id != $item->id_user)
                                                    {{-- ------------------------ --}}
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
                                                    {{-- ---------------------------- --}}
                                                @elseif(Auth::user()->id == $item->id_user && $item->status == 1 && $item->expdate >= now())
                                                    <a class="back-green rounded" href="">xe của bạn</a>
                                                @elseif(Auth::user()->id == $item->id_user && $item->status == 1 && $item->rentaldays != 0 && !$item->expdate)
                                                    <a class="back-info rounded" href="">Đang chờ duyệt</a>
                                                @elseif(Auth::user()->id == $item->id_user && $item->status == 1 && $item->rentaldays != 0 && $item->expdate < now())
                                                    <a class="back-orange rounded"
                                                        href="{{ route('rental.ad-readd', ['id' => $item->id]) }}">Gia hạn</a>
                                                @else
                                                    <a class="btn btn-primary"
                                                        href="{{ route('rental.ad-add', ['id' => $item->id]) }}">Đăng tin xe
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
                                                            <p class=" silver word-white"><i class='fa fa-circle-o'></i> Cơ
                                                                bản</p>
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
                                        <div class="bottom">
                                            @if ($item->agree == 1 && $item->given == 0)
                                                <p class=" agree word-white"><i class='fa fa-check'></i> Đã chấp thuận</p>
                                            @elseif($item->agree == 1 && $item->given == 1 && $item->take == 0)
                                                <p class=" given word-white"><i class='fa fa-car'></i> Đã giao xe</p>
                                            @elseif($item->agree == 1 && $item->given == 1 && $item->take == 1 && $item->back == 0)
                                                <p class=" take word-white"><i class='fa fa-car'></i> Đã nhận xe</p>
                                            @elseif($item->agree == 1 && $item->given == 1 && $item->take == 1 && $item->back == 1 && $item->finish == 0)
                                                <p class=" back word-white"><i class='fa fa-car'></i> Đã trả xe</p>
                                            @elseif($item->agree == 1 && $item->given == 1 && $item->take == 1 && $item->back == 1 && $item->finish == 1)
                                                <p class=" finish word-white"><i class='fa fa-car'></i> Đã kết thúc chuyến đi</p>
                                            @else
                                                <p class=" wait word-white"><i class='fa fa-send-o'></i> Đang yêu cầu</p>
                                            @endif

                                        </div>
                                        {{-- assets\clients\images\kar.jpg --}}
                                        {{-- height="200px" width="auto" --}}
                                        {{-- {{$item->image_link}} --}}
                                    </div>
                                </div>
                                {{-- /////////////////////////////////image-end///////////////////////////// --}}

                                <div class="col-md-12  col-lg-12 col-xl-12 col-sm-12 col-xxl-12">
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

                {{-- <div class="container">
        <img src="assets\clients\images\kar.jpg" alt="Avatar" class="image" id="{{$item->id}}" style="width:100%">
        <div class="middle" id="{{$item->id}}">
          <div class="text">John Doe</div>
        </div>
      </div> --}}
            @endforeach
        @else
            <tr>
                <td colspan="4">Không có xe</td>
            </tr>
        @endif
    </div>

    <!-- jQuery CDN - Phiên bản mới nhất -->
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <script>
        const containers = document.querySelectorAll('.container');

        // Lặp qua từng container và áp dụng hiệu ứng hover riêng lẻ
        containers.forEach((container) => {
            const image = container.querySelector('.image');
            const middle = container.querySelector('.middle');
            const toptop = container.querySelector('.toptop');
            const topleft = container.querySelector('.topleft');
            const bottom = container.querySelector('.bottom');

            container.addEventListener('mouseenter', () => {
                image.style.opacity = '0.3';
                middle.style.opacity = '1';
                toptop.style.opacity = '1';
                topleft.style.opacity = '1';
                bottom.style.opacity = '1';

            });

            container.addEventListener('mouseleave', () => {
                image.style.opacity = '1';
                middle.style.opacity = '0';
                toptop.style.opacity = '0';
                topleft.style.opacity = '0';
                bottom.style.opacity = '0';
            });
        });
    </script>
    <script>
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Nếu checkbox hiện đang được chọn, hủy chọn tất cả các checkbox khác cùng loại
                if (this.checked) {
                    checkboxes.forEach(otherCheckbox => {
                        if (otherCheckbox !== this && otherCheckbox.name === this.name) {
                            otherCheckbox.checked = false;
                        }
                    });
                }
            });
        });
    </script>
    <script>
        // Khởi tạo thanh trượt
        var priceSlider = document.getElementById('price-slider');
        noUiSlider.create(priceSlider, {
            start: [100, 500], // Khoảng giá ban đầu
            connect: true, // Kết nối giữa hai nút
            range: {
                'min': 0,
                'max': 1000 // Giá tiền tối đa
            }
        });

        // Lấy các phần tử DOM cho bảng hiển thị
        var minPriceTable = document.getElementById('min-price-table');
        var maxPriceTable = document.getElementById('max-price-table');

        // Cập nhật bảng khi giá trị thanh trượt thay đổi
        priceSlider.noUiSlider.on('update', function(values, handle) {
            var minPrice = values[0];
            var maxPrice = values[1];

            // Cập nhật nội dung bảng số tiền nhỏ nhất
            minPriceTable.innerHTML = 'Số tiền nhỏ nhất: ' + minPrice + ' USD';

            // Cập nhật nội dung bảng số tiền lớn nhất
            maxPriceTable.innerHTML = 'Số tiền lớn nhất: ' + maxPrice + ' USD';

            // Thực hiện tìm kiếm hoặc cập nhật dữ liệu dựa trên khoảng giá
            // Ở đây, bạn có thể gửi yêu cầu tìm kiếm dựa trên minPrice và maxPrice.
        });
    </script>

    <script>
        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;
        priceInput.forEach(input => {
            input.addEventListener("input", e => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });
        rangeInput.forEach(input => {
            input.addEventListener("input", e => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);
                if ((maxVal - minVal) < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
    </script>
    {{-- <script>
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
                    var district_sent =$('#id_model');
                    district_sent.empty();
                    $('#id_model').append($('<option>', {
                            value: 0,
                            text: "Tất cả Model"
                        }));
                    $.each(data, function(key, model) {
                        $('#id_model').append($('<option>', {
                            value: model.id{{request()->id_model==$item->id?
                            'selected':false}},
                            text: model.name
                        }));
                    });
                },
                error: function() {
                  alert('Đã có lỗi xảy ra.');
                }
              });
            });
    </script> --}}
    {{-- $('#province_receive').on('change', function() {
        var selectedValue = $(this).val();
        //alert(selectedValue);
        $.ajax({
            url: 'select-province',
              method: 'GET',
              data: {
                selectedValue: selectedValue
              },
            success: function(data) {
                var district_sent =$('#district_receive');
                district_sent.empty();
                $.each(data, function(key, district) {
                    $('#district_receive').append($('<option>', {
                        value: district.id_district,
                        text: district.district_name
                    }));
                });
            },
            error: function() {
              alert('Đã có lỗi xảy ra.');
            }
          });
        }); --}}
@endsection
