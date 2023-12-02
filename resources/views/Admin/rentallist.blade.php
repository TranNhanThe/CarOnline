@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
    
@section('content')
<h1 class="word-ash mid"><i class='fa-solid fa-car-rear'></i>&nbsp;{{$title}}</h1>
@if (session('msg'))
    <div class="alert alert-success">{{session('msg')}}</div>
@endif
<hr>
<div class="container">
<div class="text-bg">
    <form id="searchForm"  action="{{ route('admin.search') }}" method="GET">
        <div class="row"><h3><i class='fa fa-search'></i> Tìm xe thuê</h3></div>
     
        <div class="row">
            
            <div class="col-md-2 col-sm-12">           
                <input class="form-control bg-rentalcard word-white" value="{{request()->keywords}}"  type="text" id="keyword"  placeholder="Từ khóa" name="keywords">
            </div>
            <div class="col-md-2 col-sm-12">
                
                <select class="form-select bg-rentalcard word-white" id="id_make" name="id_make">
                    <option value=""><i class='fas fa-car-alt'></i>Mọi Hãng</option>
                    @if (!empty(getAllMake()))
                    @foreach (getAllMake() as $item)
                        <option value="{{$item->id}}"{{request()->id_make==$item->id?
                            'selected':false}}>{{$item->name}}</option>                           
                    @endforeach
                @endif
                    <!-- Thêm các hãng xe khác vào đây -->
                </select>
            </div>
            {{-- style="display: none;" --}}
            <div class="col-md-2 col-sm-12" id="modelField" >
                
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
                        <option value="{{$item->id}}"{{request()->id_bodytype==$item->id?
                            'selected':false}}>{{$item->name}}</option>                           
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
                        <option value="{{$item->id}}"{{request()->id_province==$item->id?
                            'selected':false}}>{{$item->name}}</option>                           
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

{{-- ---------------Thong ke------------------------ --}}

<div class="text-bg">
    <form id="searchForm"  action="{{ route('admin.search') }}" method="GET">
        <div class="row"><h3><i class='fa fa-book'></i> Thống kê</h3></div>
     
        <div class="row d-flex justify-content-center">
            
            <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1">           
               <h5 class="m-1">Tổng xe: <span class="word-rental-money">
                @php
                    $count = DB::table('rentalcar')->count();
                    echo $count;
                @endphp    
            </span></h5>
            </div>
            <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1">
                <h5 class="m-1">Tổng tin đăng: <span class="word-rental-money">
                    @php
                    $count = DB::table('ad_rent')->where('ad_rent.status', 1)->count();
                    echo $count;
                @endphp     
                </span></h5>
            </div>

            <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1" >
                <h5 class="m-1">Chưa đăng tin: <span class="word-rental-money">
                    @php
                    $huyndai = DB::table('rentalcar')->count();
                    $kia = DB::table('ad_rent')->where('ad_rent.status', 1)->count();
                    $k = $huyndai - $kia;
                    echo $k;
                @endphp    
                </span></h5>
            </div>
            <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1 ">
                <h5 class="m-1">Tin hết hạn: <span class="word-rental-money">
                    @php
                    $now = now();
                    $count = DB::table('ad_rent')->where('ad_rent.expiration_date', '<=', $now )->count();
                    echo $count;
                @endphp 
                </span></h5>
            </div>
            <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1 ">
                <h5 class="m-1">Đang hiển thị: <span class="word-rental-money">
                    @php
                    $now = now();
                    $count = DB::table('ad_rent')->where('ad_rent.expiration_date', '>', $now )->count();
                    echo $count;
                @endphp 
                </span></h5>
                
            </div>
            <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1 ">
                <h5 class="m-1">Chờ duyệt: <span class="word-rental-money">
                    @php
                    $count = DB::table('ad_rent')->where('ad_rent.status', 0)->count();
                    echo $count;
                @endphp   
                </span></h5>
            </div>
            
        </div>
        
    </form>
</div>
</div>
{{-- -------------------end thong ke--------------------------------- --}}
<br>
<table class="table table-bordered ">
    <thead>
        <tr  class="word-ash">
            <th width="2%">STT</th>
            <th width="2%"><a href="?sort-by=id&sort-type={{$sortType}}">ID</a></th>
            <th width="15%"><a href="?sort-by=car_name&sort-type={{$sortType}}">Tên Xe</a></th>
            <th width="8%"><a href="?sort-by=user_name&sort-type={{$sortType}}">Chủ Xe</a></th>
            <th width="8%"><a href="?sort-by=province_name&sort-type={{$sortType}}">Tỉnh thành</a></th>
            <th width="2%"><a href="?sort-by=rented&sort-type={{$sortType}}">Thuê</a></th>
            <th width="7%"><a href="?sort-by=adprice&sort-type={{$sortType}}">Giá - vnd</a></th>
            <th width="11%"><a href="?sort-by=adtype&sort-type={{$sortType}}">Loại Tin</a></th>
            <th><a href="?sort-by=view_count&sort-type={{$sortType}}">View</a></th>
            <th width="8%"><a href="?sort-by=expdate&sort-type={{$sortType}}">Thời hạn</a></th>
            <th width="9%">Kiểm duyệt</th>
            <th width="6%">Chi tiết</th>
            <th width="4%">Sửa</th>
            <th width="4%">Xóa</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($rentalcarList))
            @foreach ($rentalcarList as $key => $item)
        <tr  class="word-ash">
            <td>{{$key+1}}</td>
            <td>{{$item->id}}</td>
            <td>{{$item->car_name}}</td>
            <td>{{$item->user_name}}</td>
            <td>{{$item->province_name}}</td>
            
            <td>{{$item->rented}}</td>

            <td>{{ number_format($item->adprice, 0, ',', '.') }}</td>

            <td>
                
                @if ($item->adtype == 1 && $item->expdate >= now())
                <p class=" saving word-white"><i class='fa fa-flash'></i> Tiết kiệm</p>
            @elseif($item->adtype == 2 && $item->expdate >= now())
                <p class=" silver word-white"><i class='fa fa-circle-o'></i> Cơ bản</p>
            @elseif($item->adtype == 3 && $item->expdate >= now())
                <p class=" gold word-white">
                    <i class='fa fa-plus'></i> Plus</p>
            @elseif($item->adtype == 4 && $item->expdate >= now())
            <p class="platinum word-white"><i class='fa fa-star'></i> Premium</p>
            @elseif(!$item->adtype)
            <p class="chuadangtin word-white"> Chưa đăng tin</p>
            
            
            @elseif ($item->adtype == 1 && !$item->expdate)
                <p class="saving word-white"><i class='fa fa-clock'></i> Tiết kiệm</p>
            @elseif($item->adtype == 2 && !$item->expdate)
                <p class=" silver word-white"><i class='fa fa-clock'></i> Cơ bản</p>
            @elseif($item->adtype == 3 && !$item->expdate)
                <p class=" gold word-white">
                    <i class='fa fa-clock'></i> Plus</p>
            @elseif($item->adtype == 4 && !$item->expdate)
            <p class="platinum word-white"><i class='fa fa-clock'></i> Premium</p>



            @else
                    <p class="blood word-white"><i class='fa fa-warning'></i> Tin hết hạn</p>
            @endif
        
        
        </td>
        <td>{{ $item->view_count }}</td>
            <td>{{ date('d-m-Y', strtotime($item->expdate))  }}</td>    

            <td>
            @if (!$item->adtype)
            <button type="submit" class="btn btn-info">Chưa đăng</button>
            @else
            <form method="post" action="{{ route('admin.status.toggle', $item->id) }}">
                @csrf
                @method('POST') <!-- Sử dụng POST method -->
            
            
                @if ($item->ad_status == 1)
                    <button type="submit" disabled  class="btn btn-success">Đã duyệt</button>
                @else
                <button type="submit" disabled  class="btn btn-warning">Chờ duyệt</button>
                @endif
                
            </form>
            
            @endif
            
            </td>
            {{-- <td><a href="{{route('admin.rentalshow', ['id'=>$item->id])}}" class="btn btn-info btn-sm" id="viewButton" data-id="{{ $item->id }}">Xem</a>
            </td> --}}
            
            <td><a href="{{route('admin.rentalshow', ['id'=>$item->id])}}" class="btn btn-info btn-sm">Xem</a></td>
            <td><a href="{{route('admin.edit', ['id'=>$item->id])}}" class="btn btn-warning btn-sm">Sửa</a></td>
            <td><a onclick="return confirm('Xóa thật à?')" href="{{route('admin.delete',['id'=>$item->id] )}}" class="btn btn-danger btn-sm">Xóa</a></td>
        </tr>
            @endforeach
        @else 
        <tr>
            <td colspan="4">Không có người dùng</td>
        </tr>
        @endif
    </tbody>
</table>

<div class="d-flex justify-content-center">{{$rentalcarList->links()}}</div>

{{-- <script src="https://code.jquery.com/jquery.min.js"></script> --}}
{{-- <script>
    document.getElementById('viewButton').addEventListener('click', function(event) {
    event.preventDefault();
    const rentalId = this.getAttribute('data-id');

    // Gửi yêu cầu AJAX
    $.ajax({
        url: '/admin/increase-view-count/' + rentalId,
        type: 'GET',
        success: function(response) {
            // Xử lý kết quả nếu cần
            // Ví dụ: Cập nhật số lượt xem trên giao diện
        },
        error: function() {
            // Xử lý lỗi nếu cần
        }
    });
});
</script> --}}
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
@endsection