@extends('layouts.kclient')
@section('title')
    {{$title}}
@endsection

@section('content')
<div class="container">
<span class="word-ash-normal">Trang chủ -</span>  <span class="word-ash-normal">Xe thuê -</span>  <span class="word-ash">{{$rentalcar->car_name}}</span> 


<div class="row">
  <div class="col-6">
    <h1 class="my-3 word-ash">{{$rentalcar->car_name}}</h1>
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
                    <img src="{{ asset('storage/' . $image->link) }}"  class="d-block w-100 cover object-slide" alt="Ảnh {{ $key + 1 }}">
                </div>
            @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
            </div> {{-- end slide show --}}

            <h3 class="my-3 word-ash">Mô tả tổng quan</h3>

           <div class="row bg-rentalcard rounded m-1 mb-4 p-4">
            <div class="col">
              <h6><span class="word-white">Model: </span><span class="word-ash"> {{$model->name}}</span></h6>
              <h6><span class="word-white">Dòng xe: </span><span class="word-ash"> {{$bodytype->name}}</span></h6>
              <h6><span class="word-white">Dẫn động: </span><span class="word-ash"> {{$drivetrain->name}}</span></h6>
              <h6><span class="word-white">Động cơ: </span><span class="word-ash"> {{$rentalcar->engine}}</span></h6>
              <h6><span class="word-white">Hộp số: </span><span class="word-ash"> {{$transmission->name}}</span></h6>
            </div>
            <div class="col">
              <h6><span class="word-white">Loại nhiên liệu: </span><span class="word-ash"> {{$fuel->name}}</span></h6>
              <h6><span class="word-white">Màu ngoại thất: </span><span class="word-ash"> {{$rentalcar->exterior_color}}</span></h6>
              <h6><span class="word-white">Màu nội thất: </span><span class="word-ash"> {{$rentalcar->interior_color}}</span></h6>
              <h6><span class="word-white">Số ghế ngồi: </span><span class="word-ash"> {{$rentalcar->seat}}</span></h6>
              <h6><span class="word-white">VIN: </span><span class="word-ash"> {{$rentalcar->vin}}</span></h6>
            </div>
           </div> {{-- end tổng quan --}}

           <div class="row">
            {{-- ghế --}}
            <div class="col-md-4 col-sm-2">
                <div class="rounded bg-rentalcard text-white pt-3" style="width: auto; height: auto;">
                    <div class="d-flex align-items-center justify-content-center"><img src="{{ asset('assets\clients\images\rental.png') }}" width="50px" alt=""></div>
                    <div class="d-flex align-items-center justify-content-center"><h5>Đã thuê {{ $rentalcar->rented }} lần</h5></div>
                </div>
            </div>
            {{-- hộp số --}}
            <div class="col-md-4 col-sm-2">
                <div class="rounded bg-rentalcard text-white pt-3" style="width: auto; height: auto;">  
                    <div class="d-flex align-items-center justify-content-center"><img src="{{ asset('assets\clients\images\driver.png') }}" width="50px" alt=""></div>
                    <div class="d-flex align-items-center justify-content-center"><h6>
                      @if ($rentalcar->driver == 1)
                          Có kèm tài xế
                      @elseif ($rentalcar->driver == 0)
                          Không kèm tài xế
                      @else 
                          Liên hệ
                      @endif
                    </h6></div>
                </div>
            </div>
            {{-- nhiên liệu --}}
            <div class="col-md-4 col-sm-2">
                <div class="rounded bg-rentalcard text-white pt-3" style="width: auto; height: auto">
                    <div class="d-flex align-items-center justify-content-center"><img src="{{ asset('assets\clients\images\accident.png') }}" width="50px" alt=""></div>
                    <div class="d-flex align-items-center justify-content-center"><h5>
                      @if ($rentalcar->no_accident == 1)
                          Chưa từng va chạm
                      @elseif ($rentalcar->no_accident == 0)
                          Từng va chạm
                      @else
                          Không xác định
                      @endif  
                    </h5></div>
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
                     Lốp dự phòng
                @endif
              </p>
               
              <P>
                @if ($utilities->camera_lui == 1)
                    Camera Lùi
                @endif
              </P>
                
              <p>
                @if ($utilities->camera_cap_le == 1)
                     Camera Cập Lề
                @endif
              </p>
                
              <p>
                @if ($utilities->cam_bien_va_cham == 1)
                     Cảm Biến Va Chạm
                @endif
              </p>
                
              <P>
                @if ($utilities->cam_bien_lop == 1)
                   Cảm Biến Lốp  
                @endif
              </P>

              <p>
                @if ($utilities->camera_360 == 1)
                     Camera 360
                @endif
              </p>

              <p>
                @if ($utilities->tui_khi_an_toan == 1)
                     Túi Khí An Toàn
                @endif
              </p>

              

              <p>
                @if ($utilities->canh_bao_toc_do == 1)
                    Cảnh báo tốc độ 
                @endif
              </p>
            </div>

            <div class="col word-ash">
              <h3 class="word-white">Tiện Nghi</h3>

              <P>
                @if ($utilities->Bluetooth == 1)
                   Bluetooth
               @endif
             </P>

             <P>
              @if ($utilities->dinh_vi_gps == 1)
                  Định vị GPS
              @endif
            </P>

            <P>
              @if ($utilities->etc == 1)
                 ETC  
              @endif
            </P>

              <p>
                @if ($utilities->cua_so_troi == 1)
                     Cửa Sổ Trời
                @endif
              </p>

              <p>
                @if ($utilities->khe_cam_usb == 1)
                     Khe Cắm USB
                @endif
              </p>

              <p>
                @if ($utilities->camera_hanh_trinh == 1)
                     Camera Hành Trình
                @endif
              </p>

              <p>
                @if ($utilities->ghe_tre_em == 1)
                    Ghế Trẻ em 
                @endif
              </p>

              <p>
                @if ($utilities->man_hinh_dvd == 1)
                    Màn Hình DVD 
                @endif
              </p>

              <p>
                @if ($utilities->ban_do == 1)
                     Bản Đồ
                @endif
              </p>
            </div>
          </div>
          {{-- end tính năng --}}
          <h3 class="my-3 word-ash">Mô tả của chủ xe</h3> 

          <div class="bg-rentalcard word-white m-1 mb-4 p-4">
            <p  id="content">
              {{$rentalcar->mota}}
          </p><button class="btn btn-success bg-rentalcard" id="readMore">Đọc tiếp</button>
          </div>
          {{-- end mô tả chủ xe --}}
          <hr>

          <div class="row word-white">
            <div class="col-4">Ngày hiển thị: {{ date('d-m-Y', strtotime($rentalcar->created_at))  }}</div>
            <div class="col-4">Mã tin đăng: 123122</div>
            <div class="col-2">ID: {{ $rentalcar->id }}</div>
            <div class="col-2">Lượt xem: 43</div>
          </div>

          


          
            

            
        </div>
        {{-- end infocar --}}
        {{-- ------------------------------------------------------------------------------------ --}}
        {{-- info you --}}
        <div class="col-md-4">
            <div class="row container">
              <h4><div>
                @php
                $rating =  $rentalcar->star_rate ; // Đây là giá trị xếp hạng thực tế
                $fullStars = floor($rating); // Số sao đầy
                $halfStar = ($rating - $fullStars) >= 0.5; // Xem xét có hiển thị nửa sao không
                @endphp
                <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $fullStars)
                            <span class="star">&#9733;</span>
                        @elseif ($i == $fullStars + 1 && $halfStar)
                            <span class="star-half">&#9734;</span>
                        @else
                            <span class="star">&#9734;</span>
                        @endif
                    @endfor
                    <span class="word-white">{{ $rentalcar->star_rate }}</span>
                </div>
              </div></h5>
              
              {{-- end rating --}}
              <h3 class="word-white">
                @foreach ($ad_rent as $key => $item)
                {{ number_format( $item->price, 0, ',', '.') }}
                
                <span style="font-size: medium">đồng/ngày</span></h3>
              <p class="my-1 word-ash-normal"><i style="font-size: 20px" class='fa-solid fa-location-dot'></i> {{$rentalcar->location}}, {{$province->name}}</p>
              @if ($item->expiration_date >= now() && $item->status == 1)
                <div class="row">
                  <div class="col-2"> <h3><button title="Chia sẻ" class="btn" id="copy-button"><i class="fas fa-share heart-icon"></i></button></h3></div>
                        <div class="col">

                        
                          {{-- -------------------------------- --}}
                            @if (Auth::check())
                            <form action="{{ route('favorite.toggle', $rentalcar->id) }}" method="POST">
                              @csrf
                              <button class="btn" type="submit">
                                  @if (Auth::user()->hasFavorite($rentalcar->id))
                                  <h4><i class='fa fa-heart word-rental-money' title="Bỏ yêu thích" ></i> </h4>
                                  @else
                                  <h4><i class='fa fa-heart-o word-rental-money' title="Thêm vào yêu thích" ></i></h4>
                                  @endif 
                              </button>
                          </form>
                          @endif 
                          {{-- ------------------------------------------ --}}
                        
                          </div>
                          
                            <div id="message" class="alert alert-info text-center msg" style="display: none;"></div> 
              </div>
              
              @endif
                          @endforeach
             
              
              <div class="bg-rentalcard rounded m-1 mb-4 p-2">
                  <p class="word-white">Chủ Xe Tư Nhân</p>

                <div class="row">
                  <div class="col-3">
                      <div >
                        <img src="{{ asset('storage/' . $users->avatar) }}" alt="Avatar" class="rounded-circle avatar-image"> 
                      </div> 
                  </div>
                  <div class="col-9 word-white">
                      <h5 class="mt-1">{{ $users->fullname }}</h5>
                      <h6><div>
                        @php
                        $rating =  $users->user_star ; // Đây là giá trị xếp hạng thực tế
                        $fullStars = floor($rating); // Số sao đầy
                        $halfStar = ($rating - $fullStars) >= 0.5; // Xem xét có hiển thị nửa sao không
                        @endphp
                        <div class="rating">
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
                      </div></h6>
                      
                      
                  </div>
                </div>
              
                <h6 class="word-rental-money mid">{{ $users->email }}</h6>
                <a href="#" class="word-ash" style="text-decoration-line:underline"><h6>Các tin đăng khác của {{ $users->fullname }}</h6></a>
                
                <div class="btn btn-primary bg-rentalcard-in mid">
                  <h6><i style="font-size: 25px" class='fas fa-phone-volume'></i>
                   {{ $users->phone }}
                  </h6></div>


              </div>
            </div>
            @foreach ($ad_rent as $key => $item)
                
             {{-- @if ( $item->status == 1 || $item->expiration_date >= now()) --}}
              @if ($item->expiration_date >= now() && $item->status == 1)
            <div>
              
             
              
              <form action="">
                <div class="bg-rentalcard word-white rounded">
                  <h3 class="mid">Bảng tính tiền</h3>
                  
                  
                
                  <h3 class="mid word-rental-money">{{ number_format( $item->price, 0, ',', '.') }} <span class="px-1"  style="font-size: medium"> đồng/ngày</span></h3>
                  
                  <h6 class="px-4"> Ngày nhận </h6>
                  <div class="px-4">
                    <input class="form-control" type="date" name="ngaynhanxe">
                    </div>
                    <br>
                    <h6 class="px-4"> Ngày trả </h6>
                    <div class="px-4">
                      <input class="form-control" type="date" name="ngaynhanxe">
                    </div>
                    <br>
                    <h5 class="px-4">Địa điểm giao / nhận xe</h5>
                    <div class="mid p-2">
                      <p class="px-4 word-rental-money p-2 w-100 bg-rentalcard-in" class="my-1"><i style="font-size: 20px" class='fa-solid fa-location-dot'></i> {{$rentalcar->location}}, {{$province->name}}</p>
                    </div>
                    {{-- <p class="px-4 word-rental-money p-2 w-100 bg-rentalcard-in" class="my-1"><i style="font-size: 20px" class='fa-solid fa-location-dot'></i> {{$rentalcar->location}}, {{$province->name}}</p> --}}
                    
                    <h6 class="px-4"> Giao nhận </h6>
                    <div class="mid p-2"><div class=" p-2 w-100 bg-rentalcard-in ">
                        <p>Giao nhận xe tận nơi trong bán kính <span class="word-rental-money">5km</span>.</p>
                        <p>Phí giao nhận <span class="word-rental-money">Miễn phí</span>.</p>
                    </div></div>
                    
                    <h6 class="px-4"> Phụ phí </h6>
                    <div class="mid p-2"><div class=" p-2 w-100 bg-rentalcard-in ">
                      <p>Giới hạn quãng đường <span class="word-rental-money">500</span>km/ngày.</p>
                      <p>Vượt quá mỗi 1 km: <span class="word-rental-money">4000</span>đ/km. (trả thêm cho chủ xe)</p>
                  </div></div>
  
                  <h6 class="px-4"> Chi tiết giá </h6>
  
                  <table>
                    <tr>
                      <td class="px-4">{{ $model->name }}</td>

                      <td class="px-4">{{ number_format( $item->price, 0, ',', '.') }} vnđ/ngày</td>

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
                      <td class="px-4">x <span class="word-rental-money">7</span></td>
                    </tr>
                  </table>
  
                  <hr>
  
                  <table>
                    <tr>
                      <td class="px-4 mid"><h6>Tổng phí thuê xe</h6></td>
                      <td class="px-4"><h6><span class="word-rental-money">{{ number_format(($item->price+(70000)+(50000))*(7), 0, ',', '.') }}</span><span> vnđ</span> </h6></td>
                    </tr>
                  </table>
                  
                    
                    <a class="my-2 btn text-search mid mx-2" href="">Thanh toán MOMO</a>
                  
                    <a class=" btn text-search mid mx-2" href="">Thanh toán VNPAY</a>
                    <br>
  
                    <a class=" btn back-green mid mx-2" href="">Thanh toán dành cho cán bộ</a>
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
              
              <a class="btn btn-primary mid" href="{{route('rental.ad-add', ['id'=>$rentalcar->id])}}">Đăng tin xe này</a>
         </div> 
         @elseif($item->rentaldays != 0 && !$item->expiration_date < now())
         <div class="bg-rentalcard word-rental-money p-2 rounded"> 
          <h2 class="mid"><i class='fa fa-warning'></i>Tin đăng hết hạn</h2>
          <a class="back-orange rounded mid" href="{{route('rental.ad-readd', ['id'=>$rentalcar->id])}}">Gia hạn</a>
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
    <div class="row">
      <h2 class="my-3 word-ash">Có thể bạn quan tâm</h2> 
    </div>
</div>

<script>
  const contentElement = document.getElementById('content');
  const readMoreButton = document.getElementById('readMore');

  const maxWords = 45; // Số từ tối đa bạn muốn hiển thị ban đầu

  // Lấy nội dung ban đầu
  const initialContent = contentElement.textContent.trim().split(/\s+/);
  const initialWords = initialContent.slice(0, maxWords).join(' ');
  const remainingWords = initialContent.slice(maxWords).join(' ');

  contentElement.innerHTML = `${initialWords} <span id="dots">...</span><span id="more" style="display: none;">${remainingWords}</span>`;

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
  $(function(){
  $('#datepicker').datepicker();
});
</script>

<script>
  // Lấy phần tử DOM cho nút "Copy" và phần tử để hiển thị thông báo
const copyButton = document.getElementById('copy-button');
const messageElement = document.getElementById('message');

// Khởi tạo Clipboard.js
const clipboard = new ClipboardJS(copyButton, {
    text: function () {
        // Trả về đường link hiện tại làm nội dung để sao chép
        return window.location.href;
    }
});

// Xử lý khi sao chép thành công
clipboard.on('success', function (e) {
    messageElement.style.display = 'block';
    messageElement.innerText = 'Đã sao chép đường link vào clipboard.';
    e.clearSelection(); // Xóa lựa chọn để tránh hiển thị vùng được chọn.
});

// Xử lý khi sao chép thất bại
clipboard.on('error', function () {
    messageElement.style.display = 'block';
    messageElement.innerText = 'Không thể sao chép đường link.';
});

</script>

@endsection