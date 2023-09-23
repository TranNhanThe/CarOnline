@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('content')
    <h1 class="word-ash">{{$title}}</h1>
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif

    {{-- @if ($errors->any())
        <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ</div>
    @endif --}}

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
        <div class="row">
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Tên xe</label>
                    <input type="text" class="form-control" name="car_name" placeholder="Honda CR-V...." value="{{old('car_name')}}">
                    @error('car_name')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label for="">Chủ xe</label>
                    <select name="id_user" class="form-control" id="">
                        <option value="0">Chọn User</option>
                        @if (!empty($allUser))
                            @foreach($allUser as $item)
                                <option value="{{$item->id}}" {{old('id_user')==
                                $item->id?'selected':false}}>{{$item->fullname}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('id_user')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div> --}}
                
        
                <div class="mb-3">
                    <label for="">Model xe</label>
                    <select name="id_model" class="form-control" id="">
                        <option value="0">Chọn Model</option>
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
        
                <div class="mb-3">
                    <label for="">Nhiên liệu</label>
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
        
                <div class="mb-3">
                    <label for="">Dẫn động</label>
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
        
                <div class="mb-3">
                    <label for="">Hộp số</label>
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
        
                <div class="mb-3">
                    <label for="">Dòng xe</label>
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
        
                <div class="mb-3">
                    <label for="">Hãng</label>
                    <select name="id_make" class="form-control" id="">
                        <option value="0">Chọn Hãng</option>
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
                <div class="mb-3">
                    <label for="">Số ghế ngồi</label>
                    <input type="text" class="form-control" name="seat" placeholder="Honda CR-V...." value="{{old('seat')}}">
                    @error('seat')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Tỉnh thành</label>
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
        
                <div class="mb-3">
                    <label for="">Địa chỉ</label>
                    <input type="text" class="form-control" name="location" placeholder="Xã, quận, huyện...." value="{{old('location')}}">
                    @error('location')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
            
        
                <div class="mb-3">
                    <label for="">Tên động cơ</label>
                    <input type="text" class="form-control" name="engine" placeholder="Động cơ 2L...." value="{{old('engine')}}">
                    @error('engine')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="">Màu ngoại thất</label>
                    <input type="text" class="form-control" name="exterior_color" placeholder="Trắng kem..." value="{{old('exterior_color')}}">
                    @error('exterior_color')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="">Màu nội thất</label>
                    <input type="text" class="form-control" name="interior_color" placeholder="Trắng kem..." value="{{old('interior_color')}}">
                    @error('interior_color')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="">Số VIN</label>
                    <input type="text" class="form-control" name="vin" placeholder="..." value="{{old('vin')}}">
                    @error('vin')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="">Từng bị va chạm</label>
                    <select name="no_accident" class="form-control" id="">
                        <option value="0" {{old('no_accident')==
                        0?'selected':false}}>Có</option>
                        <option value="1" {{old('no_accident')==
                        1?'selected':false}}>Không</option>
                    </select>
                    
                </div>
        
                <div class="mb-3">
                    <label for="">Giá cho thuê</label>
                    <input type="text" class="form-control" name="price" placeholder="" value="{{old('price')}}">
                    @error('price')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="">Kèm tài xế</label>
                    <select name="driver" class="form-control" id="">
                        <option value="0" {{old('driver')==
                        0?'selected':false}}>Không</option>
                        <option value="1" {{old('driver')==
                        1?'selected':false}}>Có</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="rental_image">Thêm hình ảnh:</label>
                    <input type="file" name="image[]" id="image" accept="image/*"  multiple>
                        @error('image')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                </div>
                
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{route('rental.index')}}" class="btn btn-warning">Quay lại</a>
        @csrf
    </form>
@endsection