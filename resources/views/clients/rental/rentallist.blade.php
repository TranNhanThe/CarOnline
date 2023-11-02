@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('sidebar')
    <div class=" d-none d-lg-block d-sm-none d-xlg-none d-md-none mb-5">
        <form id="searchForm"  action="{{ route('search') }}" method="GET">
            <h5 class="word-white">Vị trí xe</h5>
            <div>
                
                <select class="form-select bg-rentalcard word-white" id="province" name="id_province">
                    <option value=""><i class='fas fa-car-alt'></i>Tất cả Tỉnh</option>
                    @if (!empty(getAllProvince()))
                    @foreach (getAllProvince() as $item)
                        <option value="{{$item->id}}"{{request()->id_province==$item->id?
                            'selected':false}}>{{$item->name}}</option>                           
                    @endforeach
                @endif
                    <!-- Thêm các hãng xe khác vào đây -->
                </select>
            </div>
           
            <br>
            <h5 class="word-white">Dòng xe</h5>
         
            <div class="checkbox-container custom-scrollbar">
                <!-- Danh sách các checkbox -->
                @if (!empty(getAllBodytype()))
                            @foreach (getAllBodytype() as $item)
                            <div class="form-check p-1">
                                <input class="form-check-input mx-2" type="checkbox" value="{{$item->id}}" name="id_bodytype" id="{{$item->id}}">
                                <label class="form-check-label" for="{{$item->id}}">
                                    <h6>{{$item->name}}</h6>
                                </label>
                            </div>
                            {{-- <label class="form-check-label">
                                <input class="form-check-input p-1" type="checkbox" name="id_bodytype" value="{{$item->id}}">
                                <h6>{{$item->name}}</h6>
                            </label> --}}
                            @endforeach
                        @endif
                
                <!-- Thêm các checkbox khác tại đây -->
            </div>
            <br>


            {{-- <div class="form-group row mb-3">
                <div class="col-sm-6 col-12 form-group row">
                    <div class="col-sm-10 col">
                       <select  id="getmake" class="form-select" onchange="cal_price()">
                            <option value="" selected disabled>Tất cả Hãng</option>
                            @foreach (getAllMake() as $item)
                                <option value="{{$item->id}}">{{ $item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
            {{-- ---------------------------------------------------- --}}
            <div>
                <select class="form-select bg-rentalcard word-white" name="id_make" id="id_make" onchange="cal_price()">
                    <option value=""><i class='fas fa-car-alt'></i>Tất cả hãng</option>
                    @if (!empty(getAllMake()))
                    @foreach (getAllMake() as $item)
                        <option value="{{$item->id}}"{{request()->id_make==$item->id?
                            'selected':false}}>{{$item->name}}</option>                           
                            {{-- <option value="{{$item->id}}">{{ $item->name}}</option> --}}
                    @endforeach
                @endif
                    <!-- Thêm các hãng xe khác vào đây -->
                </select>
            </div>

            {{-- <select name="district_receive" id="district_receive" class="form-select">
                <option value=""><i class='fas fa-car-alt'></i>Tất cả Model</option>

            </select> --}}
            {{-- --------------------------------------------- --}}
            <div class="pt-1">
                <select name="id_model" class="form-select bg-rentalcard word-white" id="id_model">
                    <option value=""><i class='fas fa-car-alt'></i>Tất cả Model</option>
                    {{-- @if (!empty(getAllModels()))
                    @foreach (getAllModels() as $item)
                        <option value="{{$item->id}}"{{request()->id_model==$item->id?
                            'selected':false}}>{{$item->name}}</option>                           
                    @endforeach
                @endif --}}
                    <!-- Thêm các hãng xe khác vào đây -->
                </select>
            </div>
            <br>
            <h5 class="word-white">Dẫn động</h5>
         
            <div class="checkbox-container custom-scrollbar">
                <!-- Danh sách các checkbox -->
                @if (!empty(getAllDrivetrain()))
                            @foreach (getAllDrivetrain() as $item)
                            <div class="form-check p-1">
                                <input class="form-check-input mx-2" type="checkbox" value="{{$item->id}}" name="id_drivetrain" id="{{$item->id}}+100">
                                <label class="form-check-label" for="{{$item->id}}+100">
                                    <h6>{{$item->name}}</h6>
                                </label>
                            </div>
                            {{-- <label class="form-check-label">
                                <input class="form-check-input p-1" type="checkbox" name="id_bodytype" value="{{$item->id}}">
                                <h6>{{$item->name}}</h6>
                            </label> --}}
                            @endforeach
                        @endif
                
                
            </div>
            <br>
            <h5 class="word-white">Nhiên liệu</h5>
         
            <div class="checkbox-container custom-scrollbar">
                <!-- Danh sách các checkbox -->
                @if (!empty(getAllFuel()))
                            @foreach (getAllFuel() as $item)
                            <div class="form-check p-1">
                                <input class="form-check-input mx-2" type="checkbox" value="{{$item->id}}" name="id_fuel" id="{{$item->id}}+200">
                                <label class="form-check-label" for="{{$item->id}}+2lk00">
                                    <h6>{{$item->name}}</h6>
                                </label>
                            </div>
                            {{-- <label class="form-check-label">
                                <input class="form-check-input p-1" type="checkbox" name="id_bodytype" value="{{$item->id}}">
                                <h6>{{$item->name}}</h6>
                            </label> --}}
                            @endforeach
                        @endif
                
                
            </div>
            <br>
            <h5 class="word-white">Hộp số</h5>
         
            <div class="checkbox-container custom-scrollbar">
                <!-- Danh sách các checkbox -->
                @if (!empty(getAllTransmission()))
                            @foreach (getAllTransmission() as $item)
                            <div class="form-check p-1">
                                <input class="form-check-input mx-2" type="checkbox" value="{{$item->id}}" name="id_transmission" id="{{$item->id}}+300">
                                <label class="form-check-label" for="{{$item->id}}+300">
                                    <h6>{{$item->name}}</h6>
                                </label>
                            </div>
                            {{-- <label class="form-check-label">
                                <input class="form-check-input p-1" type="checkbox" name="id_bodytype" value="{{$item->id}}">
                                <h6>{{$item->name}}</h6>
                            </label> --}}
                            @endforeach
                        @endif
                
                
            </div>
            <div class="d-none d-lg-block d-sm-none d-xlg-none d-md-none ">
                <button class="btn text-search w-100" type="submit">Tìm Kiếm</button>     
            </div>
            </form>
    </div>
        
    
    
@endsection
@section('content')
    {{-- @if (!empty($ketqua))
    <h4 class="word-white">{{$ketqua}} </h4>
        
            <button class="btn bg-rentalcard word-white"></button>
      
    @endif --}}
    <h4 class="word-white">{{ $title }}</h4>
    
    
    <div class="text-bg-bar d-lg-none flex-container rounded">
        <form id="searchForm"  action="{{ route('search') }}" method="GET">
            <div class="row">
                
                <div class="col-md-2 col-sm-12">           
                    <input class="form-control " value="{{request()->keywords}}"  type="text" id="keyword"  placeholder="Từ khóa" name="keywords">
                </div>
                <div class="col-md-2 col-sm-12">
                    
                    <select class="form-select bg-rentalcard word-white" id="make" name="id_make">
                        <option value=""><i class='fas fa-car-alt'></i>Tất cả hãng</option>
                        @if (!empty(getAllMake()))
                        @foreach (getAllMake() as $item)
                            <option value="{{$item->id}}"{{request()->id_make==$item->id?
                                'selected':false}}>{{$item->name}}</option>                           
                        @endforeach
                    @endif
                       
                    </select>
                </div>
                
                <div class="col-md-2 col-sm-12" id="modelField" >
                    
                    <select class="form-select bg-rentalcard word-white" id="model" name="id_model">
                        <option value=""><i class='fas fa-car-alt'></i>Tất cả Model</option>
                        @if (!empty(getAllModels()))
                        @foreach (getAllModels() as $item)
                            <option value="{{$item->id}}"{{request()->id_model==$item->id?
                                'selected':false}}>{{$item->name}}</option>                           
                        @endforeach
                    @endif
                       
                    </select>
                </div>
              
                


                <div class="col-md-2 col-sm-12">
                    
                    <select class="form-select bg-rentalcard word-white" id="bodytype" name="id_bodytype">
                        <option value=""><i class='fas fa-car-alt'></i>Tất cả Dòng xe</option>
                        @if (!empty(getAllBodytype()))
                        @foreach (getAllBodytype() as $item)
                            <option value="{{$item->id}}"{{request()->id_bodytype==$item->id?
                                'selected':false}}>{{$item->name}}</option>                           
                        @endforeach
                    @endif
                        
                    </select>
                    
                </div>
                <div class="col-md-2 col-sm-12">
                    <select class="form-select bg-rentalcard word-white" id="province" name="id_province">
                        <option value=""><i class='fas fa-car-alt'></i>Tất cả Tỉnh</option>
                        @if (!empty(getAllProvince()))
                        @foreach (getAllProvince() as $item)
                            <option value="{{$item->id}}"{{request()->id_province==$item->id?
                                'selected':false}}>{{$item->name}}</option>                           
                        @endforeach
                    @endif
                        
                    </select>
                    
                </div>
                <div class="col-md-2 col-sm-12">
                    <button class="btn text-search" width="100%" type="submit">Tìm Kiếm</button>
                </div>

                {{-- <div class="wrapper">
                    <header>
                      <h2>Price Range</h2>
                      <p>Use slider or enter min and max price</p>
                    </header>
                    <div class="price-input">
                      <div class="field">
                        <span>Min</span>
                        <input type="number" class="input-min" value="2500">
                      </div>
                      <div class="separator">-</div>
                      <div class="field">
                        <span>Max</span>
                        <input type="number" class="input-max" value="7500">
                      </div>
                    </div>
                    <div class="slider">
                      <div class="progress"></div>
                    </div>
                    <div class="range-input">
                      <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                      <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
                    </div>
                  </div> --}}
                
            </div>
            
        </form>
    </div>
 
    
    
    <hr>


    {{-- <div class="form-group row mb-3">
        <div class="col-sm-6 col-12 form-group row">
            <div class="col-sm-10 col">
               <select  id="getmake" class="form-select" onchange="cal_price()">
                    <option value="" selected disabled>Tất cả Hãng</option>
                    @foreach (getAllMake() as $item)
                        <option value="{{$item->id}}">{{ $item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-6 col-12 form-group row">
            <div class="col-sm-10 col">
                <select name="district_receive" id="district_receive" class="form-select">
                    <option value=""><i class='fas fa-car-alt'></i>Tất cả Model</option>

                </select>
            </div>
        </div>
    </div> --}}
    {{-- <form action="" method="get" class="mb-3">
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên xe</th>
                <th>Chủ xe</th>
                <th>Model</th>
                <th>Fuel</th>
                <th>DriveTrain</th>
                <th>Transmission</th>
                <th>Body</th>
                <th>Make</th>
                <th>Province</th>
                <th>image</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($rentalcarList))
                @foreach ($rentalcarList as $key => $item)
            <tr>
                <td>{{$item->car_name}}</td>
                <td>{{$item->user_name}}</td>
                <td>{{$item->model_name}}</td>
                <td>{{$item->fuel_name}}</td>
                <td>{{$item->drivetrain_name}}</td>
                <td>{{$item->transmission_name}}</td>
                <td>{{$item->bodytype_name}}</td>
                <td>{{$item->make_name}}</td>
                <td>{{$item->province_name}}</td>
                <td><p><img src="{{$item->image_link}}" width="100" alt=""></p></td>
            </tr>
                @endforeach
            @else 
            <tr>
                <td colspan="4">Không có xe</td>
            </tr>
            @endif
        </tbody>
    </table>

 


    <div class="d-flex justify-content-end">{{$rentalcarList->links()}}</div> --}}
    {{-- class="img-fluid" --}}
<div class="row">
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    @if (!empty($rentalcarList))
    @foreach ($rentalcarList as $key => $item)
    {{-- <div class="container mb-3 col-12 col-md-12 col-lg-12 col-xl-4 "> --}}
        <div class="container mb-3 col-12 col-lg-12 col-md-12 col-sm-6 col-xxl-12">
        <div class="container">
        
            <div class=" bg-rentalcard rounded-open">
              
<div class="row">
    
                {{-- /////////////////////////////////image///////////////////////////// --}}
                <div class="col-md-12 col-lg-5 col-xl-5 col-sm-12 col-xxl-5">

                    <div class="rounded-image-open container-flex">

                        {{-- <img src="public/storage/{{$item->image_link}}" class="image cover object" id="{{$item->id}}"> --}}
                        <a href="{{route('rental.show', ['id'=>$item->id])}}"><img src="{{ asset('storage/' . $item->image_link) }}" class="image cover object" id="{{$item->id}}"></a>

                        <div class="middle" id="1{{$item->id}}">
                    @if (!empty(Auth::user()))
                        @if (Auth::user()->id != $item->id_user)
                            {{-- ------------------------ --}}
                            @if (Auth::check())
                            <form action="{{ route('favorite.toggle', $item->id) }}" method="POST">
                                @csrf
                                <button class="btn" type="submit">
                                    @if (Auth::user()->hasFavorite($item->id))
                                    <i class='fa fa-heart word-rental-money' title="Bỏ yêu thích" style="font-size: 30px"></i> 
                                    @else
                                    <i class='fa fa-heart-o word-rental-money' title="Thêm vào yêu thích" style="font-size: 30px"></i>
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
                            <a class="back-orange rounded" href="{{route('rental.ad-readd', ['id'=>$item->id])}}">Gia hạn</a>
                        @else
                                <a class="btn btn-primary" href="{{route('rental.ad-add', ['id'=>$item->id])}}">Đăng tin xe này</a>
                        @endif
                    @endif
                        </div>

                        <div class="toptop" id="2{{$item->id}}">

                            <div>

                                <img src=" {{asset('assets\clients\images\logotimotopj.png')  }} " 
                           
    class="rounded img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
    
                            </div>
                        </div>

                        <div class="topleft" id="3{{$item->id}}">

                            <div>
                                @if (!empty($item->ad_status))
                                    
                                
                                @if ($item->ad_status == 1 )
                                    @if ($item->adtype == 1 && $item->expdate >= now())
                                    <p class=" saving word-white"><i class='fa fa-flash'></i> Tiết kiệm</p>
                                @elseif($item->adtype == 2 && $item->expdate >= now())
                                    <p class=" silver word-white"><i class='fa fa-circle-o'></i> Cơ bản</p>
                                @elseif($item->adtype == 3 && $item->expdate >= now())
                                    <p class=" gold word-white">
                                        <i class='fa fa-plus'></i> Plus</p>
                                @elseif($item->adtype == 4 && $item->expdate >= now())
                                <p class="platinum word-white"><i class='fa fa-star'></i> Premium</p>
                                @else
                                        <p class="blood word-white"><i class='fa fa-warning'></i> Tin hết hạn</p>
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
                
                <div class="col-md-6  col-lg-7 col-xl-7 col-sm-12 col-xxl-7">
                    <div class="row container">
                        
                        <div class="col-md-8 col-sm-8">
                            <p class="my-1 word-ash-normal">{{ date('d-m-Y', strtotime($item->created_at)) }}</p>
                           <a href="{{route('rental.show', ['id'=>$item->id])}}"><h4 class="my-1 word-ash">{{$item->car_name}}</h4></a> 
                           @if (!empty($item->ad_status))
                            <p class="my-1 word-rental-money">{{ number_format($item->adprice, 0, ',', '.') }} Đồng/ngày</p>
                        @endif
                            <p class="my-1 word-ash-normal"><i style="font-size: 20px" class='fa-solid fa-location-dot'></i> {{$item->location}}, {{$item->province_name}}</p>
                            
                        </div>

                        <div class="col-md-4 col-sm-4  ">

                           <div class="d-flex align-items-center justify-content-center">

                            <img src="{{ asset('assets\clients\images\rental.png') }}" class="pt-2" width="30px" alt="" > <h3 class="word-ash-normal pt-3">: {{$item->rented}}</h3>
                        </div>
                            {{-- đã thuê n lần --}}
                            
                           {!!$item->driver==0?'<button class="btn btn-danger btn-sm mt-3">Không kèm tài xế</button>':
                           '<button class="btn btn-success btn-sm mt-3">Có kèm tài xế</button>'!!}
                        </div>

                    </div>

                        <hr>

                    <div class="row container hidden-on-sm pb-3">
                        {{-- ghế --}}
                        <div class="col-md-4 col-sm-2">
                            <div class="rounded bg-rentalcard-in text-white pt-3" style="width: auto; height: auto;">
                                <div class="d-flex align-items-center justify-content-center"><img src="{{ asset('assets\clients\images\seat2.png') }}" width="30px" alt=""></div>
                                <div class="d-flex align-items-center justify-content-center"><h5>{{$item->seat}}</h5></div>
                            </div>
                        </div>
                        {{-- hộp số --}}
                        <div class="col-md-4 col-sm-2">
                            <div class="rounded bg-rentalcard-in text-white pt-3" style="width: auto; height: auto;">  
                                <div class="d-flex align-items-center justify-content-center"><img src="{{ asset('assets\clients\images\gearboxpro.png') }}" width="30px" alt=""></div>
                                <div class="d-flex align-items-center justify-content-center"><h6>{{$item->transmission_name}}</h6></div>
                            </div>
                        </div>
                        {{-- nhiên liệu --}}
                        <div class="col-md-4 col-sm-2">
                            <div class="rounded bg-rentalcard-in text-white pt-3" style="width: auto; height: auto">
                                <div class="d-flex align-items-center justify-content-center"><img src="{{ asset('assets\clients\images\fuel.png') }}" width="30px" alt=""></div>
                                <div class="d-flex align-items-center justify-content-center"><h5>{{$item->fuel_name}}</h5></div>
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
    
    container.addEventListener('mouseenter', () => {
        image.style.opacity = '0.3';
        middle.style.opacity = '1';
        toptop.style.opacity = '1';
        topleft.style.opacity = '1';
        
    });

    container.addEventListener('mouseleave', () => {
        image.style.opacity = '1';
        middle.style.opacity = '0';
        toptop.style.opacity = '0';
        topleft.style.opacity = '0';
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
priceSlider.noUiSlider.on('update', function (values, handle) {
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
priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});
rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);
        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});
</script>
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
    </script>
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