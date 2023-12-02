@extends('layouts.admin')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <h1 class="word-ash mid"><i class='fa-solid fa-car-rear'></i>&nbsp;{{ $title }}</h1>
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <hr>
    <div class="container">


        {{-- ---------------Thong ke------------------------ --}}

        <div class="text-bg">
            <form id="searchForm" action="{{ route('admin.search') }}" method="GET">
                <div class="row">
                    <h3><i class='fa fa-book'></i> Thống kê</h3>
                </div>

                <div class="row d-flex justify-content-center">

                    <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1">
                        <h5 class="m-1">Tổng số Hợp đồng: <span class="word-rental-money">
                                @php
                                    $count = DB::table('sub_rental')->count();
                                    echo $count;
                                @endphp
                            </span></h5>
                    </div>
                    <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1">
                        <h5 class="m-1">Đã hoàn thành: <span class="word-rental-money">
                                @php
                                    $count = DB::table('sub_rental')
                                        ->where('sub_rental.finish', 1)
                                        ->count();
                                    echo $count;
                                @endphp
                            </span></h5>
                    </div>

                    <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1">
                        <h5 class="m-1">Chưa chấp thuận: <span class="word-rental-money">
                                @php
                                    $count = DB::table('sub_rental')
                                        ->where('sub_rental.agree', 0)
                                        ->count();
                                    echo $count;
                                @endphp
                            </span></h5>
                    </div>
                    <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1 ">
                        <h5 class="m-1">Đang hoạt động: <span class="word-rental-money">
                                @php
                                    $now = now();
                                    $count = DB::table('sub_rental')
                                        ->where('sub_rental.agree', 1)
                                        ->where('sub_rental.finish', 0)
                                        ->count();
                                    echo $count;
                                @endphp
                            </span></h5>
                    </div>
                    <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1 ">
                        <h5 class="m-1">Chưa hoàn tiền: <span class="word-rental-money">
                                @php
                                    $now = now();
                                    $count = DB::table('sub_rental')
                                        ->where('sub_rental.finish', 1)
                                        ->where('sub_rental.pay', 0)
                                        ->where('sub_rental.depo', 0)
                                        ->count();
                                    echo $count;
                                @endphp
                            </span></h5>

                    </div>
                    <div class="col-md-3 col-sm-12 bg-rentalcard-in rounded m-1 p-1 ">
                        <h5 class="m-1">Chưa Check: <span class="word-rental-money">
                                @php
                                    $count = DB::table('sub_rental')
                                        ->orwhere('sub_rental.dealer_check', 0)
                                        ->orwhere('sub_rental.user_check', 0)
                                        ->count();
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
            <tr class="word-ash">
                <th width="2%">STT</th>
                <th width="2%"><a href="?sort-by=id&sort-type={{ $sortType }}">ID</a></th>
                <th width="10%"><a href="?sort-by=car_name&sort-type={{ $sortType }}">Tên Xe</a></th>
                <th width="8%"><a href="?sort-by=user_name&sort-type={{ $sortType }}">Bên cho thuê</a></th>
                <th width="8%"><a href="?sort-by=user_name&sort-type={{ $sortType }}">Bên thuê</a></th>
                <th width="2%"><a href="?sort-by=rented&sort-type={{ $sortType }}">Số ngày</a></th>
                <th width="7%">Ngày nhận</th>
                <th width="7%">Ngày trả</th>
                <th width="6%">Tổng tiền</th>
                <th width="5%">Cọc</th>
                <th width="6%">Chuyển chủ</th>
                <th width="6%">Thu nhập</th>
                <th width="8%">Tình trạng</th>
                <th width="3%">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($rentalcarList))
                @foreach ($rentalcarList as $key => $item)
                    @php
                        $dichvu = $item->days * 50000;
                        $baohiem = $item->days * 70000;
                        $thunhap = (($item->total - $item->deposit - $dichvu - $baohiem) / 100) * 90;
                        $hoahong = (($item->total - $item->deposit - $dichvu - $baohiem) / 100) * 10;
                    @endphp
                    <tr class="word-ash">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->sub_id }}</td>
                        <td>{{ $item->car_name }}</td>
                        <td>{{ $item->user_name }}</td>
                        <td>
                            {{ \App\Models\User::where('id', $item->customa)->first()->fullname }}
                        </td>
                        <td>{{ $item->days }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->received_date)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->return_date)) }}</td>
                        <td>{{ number_format($item->total, 0, ',', '.') }}</td>

                        <td>
                            {{ number_format($item->deposit, 0, ',', '.') }}
                            <form method="post" action="{{ route('admin.depo.toggle', $item->sub_id) }}">
                                @csrf
                                @method('POST') <!-- Sử dụng POST method -->
                            
                            
                                @if ($item->depo == 1)
                                    <button type="submit" disabled  class="btn btn-success">Đã hoàn tiền</button>
                                @else
                                <button type="submit"  class="btn btn-warning">Hoàn tiền</button>
                                @endif
                                
                            </form>
                        </td>

                        <td>
                            {{ number_format($thunhap, 0, ',', '.') }}
                            <form method="post" action="{{ route('admin.pay.toggle', $item->sub_id) }}">
                                @csrf
                                @method('POST') <!-- Sử dụng POST method -->
                            
                            
                                @if ($item->pay == 1)
                                    <button type="submit" disabled  class="btn btn-success">Đã hoàn tiền</button>
                                @else
                                <button type="submit"  class="btn btn-warning">Hoàn tiền</button>
                                @endif
                                
                            </form>
                        </td>


                        <td>{{ number_format($hoahong, 0, ',', '.') }}</td>

                        <td>
                            @if ($item->agree == 1)
                                @if ($item->given == 1)
                                    @if ($item->take == 1)
                                        @if ($item->back == 1)
                                            @if ($item->finish == 1)
                                                @if ($item->pay == 1 && $item->depo == 1)
                                                    @if ($item->dealer_check == 1 && $item->user_check == 1)
                                                        Hoàn Thành
                                                    @else
                                                        Chưa check
                                                    @endif
                                                @else
                                                    Chưa hoàn tiền
                                                @endif
                                            @else
                                                Đã trả xe
                                            @endif
                                        @else
                                            Đã nhận xe
                                        @endif
                                    @else
                                        Đã giao xe
                                    @endif
                                @else
                                    Đã chấp nhận
                                @endif
                            @else
                                Chưa chấp nhận
                            @endif




                        </td>
                        {{-- <td><a href="{{route('admin.rentalshow', ['id'=>$item->id])}}" class="btn btn-info btn-sm" id="viewButton" data-id="{{ $item->id }}">Xem</a>
            </td> --}}

                        <td><a href="{{ route('admin.contract', ['id' => $item->sub_id]) }}"
                                class="btn btn-info btn-sm">Xem</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">Không có người dùng</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">{{ $rentalcarList->links() }}</div>

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
                    var district_sent = $('#id_model');
                    district_sent.empty();
                    $('#id_model').append($('<option>', {
                        value: 0,
                        text: "Tất cả Model"
                    }));
                    $.each(data, function(key, model) {
                        $('#id_model').append($('<option>', {
                            value: model
                                .id{{ request()->id_model == $item->id ? 'selected' : false }},
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
