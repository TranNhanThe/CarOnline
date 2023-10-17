@extends('layouts.kclient')
@section('title')
    {{$title}}
@endsection

@section('content')
<h3 class="word-ash mid">{{$title}}</h3>
<form action="" method="POST" enctype="multipart/form-data">
    <hr>
    <div class="row justify-content-center p-3">
        
        <div class=" col-5 bg-rentalcard p-4 ">
            <h4 class="mid word-rental-money">Đăng tin cho: {{$rentalcar->car_name}}</h4>
            <div class="row justify-content-center container">
                <div class="col-6">
                    <label for="moneyInput" class="col-form-label"><h5>Phí thuê trên ngày</h5></label>
                  </div>
                <div class="col-6">
                    <input type="text" id="moneyInput" class="form-control" name="price" placeholder=".vnđ/ngày" value="{{ number_format(old('price'), 0, ',', '.') }}">
                    @error('price')
                  <span style="color: red;">{{$message}}</span>
                  @enderror
                  </div>
            </div>
            <div class="row justify-content-center container">
                <div class="col-6">
                    <label  class="col-form-label"><h5>Chọn gói tin đăng</h5></label>
                  </div>
                  <div class="col-6">
                    <select name="id_adtype" class="form-control" id="">
                        <option value="0">Chọn Gói</option>
                        @if (!empty($allAdtype))
                            @foreach($allAdtype as $item)
                                <option value="{{$item->id}}" {{old('id_adtype')==
                                $item->id?'selected':false}}>{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('id_adtype')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="row justify-content-center container">
                <div class="col-6">
                    <label for="moneyInput" class="col-form-label"><h5>Chọn ngày hết hạn</h5></label>
                  </div>
                <div class="col-6">
                    
                        <input class="form-control" type="date" name="expiration_date">
                        @error('expiration_date')
                    <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
                  
            </div>
    
            <div class="row justify-content-center container">
                <div class="col-6">
                    <label for="moneyInput" class="col-form-label"><h5>Tổng cộng</h5></label>
                  </div>
                <div class="col-6">
                    
                        <h5 class="word-rental-money">500 <span class="word-white">Credit</span></h5>
                        
                </div>
                  
            </div>
            <div class="row justify-content-center container">
                <div class="col-6">
                    <label for="moneyInput" class="col-form-label"><h5>Số dư của bạn</h5></label>
                  </div>
                <div class="col-6">
                    
                        <h5 class="word-green">{{ auth()->user()->credit }} <span class="word-white">Credit</span></h5>
                        
                </div>
                
            <div class="row justify-content-center container">
                <div class="col-5">
                    
                    <h5><a class="btn text-search mid " href="{{route('rental.credit')}} ">Nạp Credit</a></h5> 
                     
             </div>
                <div class="col-5">
                    <button type="submit" title="Thanh toán"  class="btn back-green mid  "> Thanh toán</button>

            </div>
            
    
                  
            </div>
        </div>
    </div>
   
        
@csrf
</form>          

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