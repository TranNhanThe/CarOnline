@extends('layouts.kclient')
@section('title')
    {{$title}}
@endsection

@section('content')
    <h1 class="word-ash">{{$title}}</h1>
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif

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

   
    <form action="" method="POST" enctype="multipart/form-data">
        
        <hr>
        <div class="row container">

            <div class="col-lg-6">

                <div class="row g-3 align-items-center">
                    <div class="col-4">
                      <label for="carname" class="col-form-label"><h5>Tiêu đề</h5></label>
                    </div>
                    <div class="col-8">
                      <input type="text" id="carname" class="form-control" name="car_name" placeholder="Honda CR-V...." value="{{old('car_name')}}">
                      @error('car_name')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>
                    
                </div>
                <br>
                <div class="row g-3 align-items-center">
                    <div class="col-4">

                       
                        <select name="id_make" class="form-control" id="id_make" onchange="cal_price()">
                            <option value="">Chọn Hãng</option>
                            @if (!empty($allMake))
                                @foreach($allMake as $item)

                                    <option value="{{$item->id}}" {{old('id_make')==
                                    $item->id?'selected':false}}>{{$item->name}}</option>

                                     

                                @endforeach
                            @endif
                        </select>
                        @error('id_make')
                        <span style="color: red;">{{$message}}</span>
                        @enderror

                    </div>

                    <div class="col-4">

                       

                        <select name="id_model" class="form-control" id="id_model">
                            <option value="">Chọn Model</option>

                            @if (!empty($allModel))
                                @foreach($allModel as $item)
                                    <option value="{{$item->id}}" {{old('id_model')==
                                    $item->id?'selected':false}}>{{$item->name}}</option>
                                @endforeach
                            @endif

                        </select>
                        @error('id_model')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>

                    

                    <div class="col-4">
                        <select name="id_drivetrain" class="form-control" id="">
                            <option value="0">Chọn Dẫn động</option>
                            @if (!empty($allDrivetrain))
                                @foreach($allDrivetrain as $item)
                                    <option value="{{$item->id}}" {{old('id_drivetrain')==
                                    $item->id?'selected':false}}>{{$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('id_drivetrain')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <br>
                <div class="row g-3 align-items-center">

                <div class="col-4">
                    <select name="id_transmission" class="form-control" id="">
                        <option value="0">Chọn Hộp số</option>
                        @if (!empty($allTransmission))
                            @foreach($allTransmission as $item)
                                <option value="{{$item->id}}" {{old('id_transmission')==
                                $item->id?'selected':false}}>{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('id_transmission')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                    
                </div>

                <div class="col-4">
                    <select name="id_bodytype" class="form-control" id="">
                        <option value="0">Chọn dòng xe</option>
                        @if (!empty($allBodytype))
                            @foreach($allBodytype as $item)
                                <option value="{{$item->id}}" {{old('id_bodytype')==
                                $item->id?'selected':false}}>{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('id_bodytype')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-4">
                    <select name="id_fuel" class="form-control" id="">
                        <option value="0">Chọn Nhiên liệu</option>
                        @if (!empty($allFuel))
                            @foreach($allFuel as $item)
                                <option value="{{$item->id}}" {{old('id_fuel')==
                                $item->id?'selected':false}}>{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('id_fuel')
                <span style="color: red;">{{$message}}</span>
                @enderror
                </div>
                </div>
                <br>
                <div class="row g-3 align-items-center">
                    <div class="col-4">
                      <label for="moneyInput" class="col-form-label"><h5>Biển kiểm soát</h5></label>
                    </div>
                    
                    <div class="col-4">
                        <input type="text"  class="form-control" name="bsx" placeholder="12A-12345" value="{{old('bsx')}}">
                        @error('bsx')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                      </div>
                      <div class="col-4">
                        <input type="text"  class="form-control" name="seat" placeholder="Số chỗ ngồi" value="{{old('seat')}}">
                        @error('seat')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                        {{-- <input type="text" disabled id="moneyInput" class="form-control blood word-white"  placeholder=".vnđ/ngày" value="Giá thuê (thêm sau)"> --}}
                      </div>
                </div>

                <br>
                <div class="row g-3 align-items-center">
                    <div class="col-4">
                      <label  class="col-form-label"><h5>Màu xe</h5></label>
                    </div>
                    <div class="col-4">
                      <input type="text"  class="form-control" name="interior_color" placeholder="Nội thất" value="{{old('interior_color')}}">
                      @error('interior_color')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-4">
                        <input type="text"  class="form-control" name="exterior_color" placeholder="Ngoại thất" value="{{old('exterior_color')}}">
                        @error('exterior_color')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                      </div>
                </div>

                <br>
                <div class="row g-3 align-items-center">
                    <div class="col-8">
                      <input type="text"  class="form-control" name="location" placeholder="Địa chỉ (xã, quận, huyện,...)" value="{{old('location')}}">
                      @error('location')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-4">
                        <select name="id_province" class="form-control" id="">
                            <option value="0">Chọn Tỉnh thành</option>
                            @if (!empty($allProvince))
                                @foreach($allProvince as $item)
                                    <option value="{{$item->id}}" {{old('id_province')==
                                    $item->id?'selected':false}}>{{$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('id_province')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>
                </div>

                <br>
                <div class="row g-3 align-items-center">
                    <div class="col-6">
                      <input type="text"  class="form-control" name="engine" placeholder="Tên động cơ" value="{{old('engine')}}">
                      @error('engine')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-6">
                        <input type="text"  class="form-control" name="vin" placeholder="Số Vin" value="{{old('vin')}}">
                        @error('vin')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                      </div>
                </div>

                <br>
                <div class="row g-3 align-items-center">
                    <div class="col-3">
                        <label  class="col-form-label"><h5>Từng va chạm</h5></label>
                    </div>
                    <div class="col-3">
                        <select name="no_accident" class="form-control" id="">
                            <option value="0" {{old('no_accident')==
                            0?'selected':false}}>Có</option>
                            <option value="1" {{old('no_accident')==
                            1?'selected':false}}>Không</option>
                        </select>
                        
                    </div>
                    <div class="col-3">
                        <label  class="col-form-label"><h5>Kèm tài xế</h5></label>
                    </div>
                    <div class="col-3">
                        <select name="driver" class="form-control" id="">
                            <option value="0" {{old('driver')==
                            0?'selected':false}}>Không</option>
                            <option value="1" {{old('driver')==
                            1?'selected':false}}>Có</option>
                        </select>
                      </div>
                </div>
            </div> 

            {{-- ranh giữa --}}

            <div class="col-lg-6">
                
                <div class="row g-3 align-items-center">
                    <div class="col-2">
                      <label for="mota" class="col-form-label"><h5>Mô tả</h5></label>
                    </div>
                    <div class="col-10 ">
                      <textarea type="text" id="mota" class="form-control" name="mota" placeholder="Chia sẻ thêm về xe của bạn" value="{{old('mota')}}"></textarea>
                      @error('mota')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>
                </div>
<br>
                <div class="row g-3 align-items-center">

                    <div class="col-6">
                        <h5 class="word-white">Tính năng an toàn</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="camera_lui" id="camera_lui">
                            <label class="form-check-label" for="camera_lui">
                                <h6>Camera Lùi</h6>
                            </label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="cam_bien_lop" id="cam_bien_lop">
                            <label class="form-check-label" for="cam_bien_lop">
                                <h6>Cảm biến lốp</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="tui_khi_an_toan" id="tui_khi_an_toan">
                            <label class="form-check-label" for="tui_khi_an_toan">
                                <h6>Túi khí an toàn</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="lop_du_phong" id="lop_du_phong">
                            <label class="form-check-label" for="lop_du_phong">
                                <h6>Lốp dự phòng</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="camera_cap_le" id="camera_cap_le">
                            <label class="form-check-label" for="camera_cap_le">
                                <h6>Camera cập lề</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="cam_bien_va_cham" id="cam_bien_va_cham">
                            <label class="form-check-label" for="cam_bien_va_cham">
                                <h6>Cảm biến va chạm</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="camera_360" id="camera_360">
                            <label class="form-check-label" for="camera_360">
                                <h6>Camera 360 độ</h6>
                            </label>
                        </div>

                        

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="canh_bao_toc_do" id="canh_bao_toc_do">
                            <label class="form-check-label" for="canh_bao_toc_do">
                                <h6>Cảnh báo tốc độ</h6>
                            </label>
                        </div>

                    
                    </div>
                    {{-- ranh --}}
                   
                    <div class="col-6">
                        <h5 class="word-white">Tính năng tiện nghi</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="dinh_vi_gps" id="dinh_vi_gps">
                            <label class="form-check-label" for="dinh_vi_gps">
                                <h6>Định vị GPS</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="ghe_tre_em" id="ghe_tre_em">
                            <label class="form-check-label" for="ghe_tre_em">
                                <h6>Ghế trẻ em</h6>
                            </label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="etc" id="etc">
                            <label class="form-check-label" for="etc">
                                <h6>ETC</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="Bluetooth" id="Bluetooth">
                            <label class="form-check-label" for="Bluetooth">
                                <h6>Bluetooth</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="khe_cam_usb" id="khe_cam_usb">
                            <label class="form-check-label" for="khe_cam_usb">
                                <h6>USB</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="camera_hanh_trinh" id="camera_hanh_trinh">
                            <label class="form-check-label" for="camera_hanh_trinh">
                                <h6>Camera hành trình</h6>
                            </label>
                        </div>

                        

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="cua_so_troi" id="cua_so_troi">
                            <label class="form-check-label" for="cua_so_troi">
                                <h6>Cửa sổ trời</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="man_hinh_dvd" id="man_hinh_dvd">
                            <label class="form-check-label" for="man_hinh_dvd">
                                <h6>Màn hình DVD</h6>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="ban_do" id="ban_do">
                            <label class="form-check-label" for="ban_do">
                                <h6>Bản Đồ</h6>
                            </label>
                        </div>

                    
                    </div>
            </div>

            <div class="row g-3 align-items-center">
                <div class="mb-3">
                    <label for="rental_image"><h5>Thêm hình ảnh:</h5>Ảnh đầu tiên được chọn sẽ là ảnh đại diện</label>
                    <input class="text-bg form-control"  type="file" name="image[]" id="image" accept="image/*"  multiple>
                        @error('image')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                </div>
            </div>

        </div>
        

        <hr class="text-white">
        <div class="d-flex justify-content-center m-4">
            <button type="submit" title="Thêm mới"  class="btn btn-primary bg-rentalcard m-3 "><h3><i class='fa fa-plus'></i> Thêm mới</h3></button>
            <a href="{{route('rental.index')}}" class="btn btn-warning bg-rentalcard text-white m-3"><h3><i class='fa fa-undo'></i> Quay lại</h3></a>
        </div>
       
        @csrf
    </form>
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
                error: function(xhr, status, error) {
                //   alert('Đã có lỗi xảy ra.');
                alert('Có lỗi xảy ra: ' + error);  
                }
              });
            });
    </script>
    <script>

        document.getElementById("moneyInput").addEventListener("input", function (e) {
            // Lấy giá trị từ trường nhập liệu
            let inputValue = e.target.value;
            
            // Loại bỏ các dấu chấm và ký tự không phải số
            inputValue = inputValue.replace(/[^\d]/g, "");
            
            // Định dạng giá trị với dấu chấm ngăn cách mỗi 3 chữ số
            inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            // Gán giá trị đã định dạng lại vào trường nhập liệu
            e.target.value = inputValue;
        });
        </script>
        
@endsection