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
  <div class="col-6 d-flex justify-content-end word-ash"> {{-- tim and share --}}
    <h4><i class="fas fa-heart heart-icon"></i> <i class="fas fa-share heart-icon"></i></h4>
  </div>
</div>



    <div class="row">
        {{-- infocar --}}
        <div class="col-md-8">
           
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            @foreach ($rental_image as $key => $image)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $image->link) }}" class="d-block w-100" alt="Ảnh {{ $key + 1 }}">
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
              <h3 class="word-white">{{ number_format($rentalcar->price, 0, ',', '.') }} <span style="font-size: medium">đồng/ngày</span></h3>
              <p class="my-1 word-ash-normal"><i style="font-size: 20px" class='fa-solid fa-location-dot'></i> {{$rentalcar->location}}, {{$province->name}}</p>
              
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
                <br>
                <h6 class="word-rental-money">{{ $users->email }}</h6>
                <a href="#" class="word-ash" style="text-decoration-line:underline"><h6>Các tin đăng khác của {{ $users->fullname }}</h6></a>
                
                <div class="btn btn-primary bg-rentalcard-in">
                  <h6><i style="font-size: 25px" class='fas fa-phone-volume'></i>
                   {{ $users->phone }}
                  </h6></div>


              </div>
            </div>
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

@endsection