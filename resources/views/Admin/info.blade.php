@extends('layouts.admin')
@section('title')
    {{ $title }}
@endsection
@if (session('msg'))
    <div class="alert alert-success">{{session('msg')}}</div>
@endif
@section('content')
<div class="container">
    <div class="row word-white">
        <div class="col d-flex justify-content-center">
            <div>
                <h3>Họ và Tên: <span class="word-rental-money">{{  $users->fullname }}</span></h3>
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            <div>
                <h3>ID Timoto: <span class="word-rental-money">{{ $users->id }}</span></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col d-flex justify-content-center">
            <img src="{{ asset('storage/' . $users->avatar) }}" alt="Avatar" class="rounded-circle avatar-image-xl">
        </div>
    </div>
    <span class="word-rental-money"></span>
    <div class="row word-white">
        <div class="col d-flex justify-content-center">
            <div>
                <h4>
                    <table>
                        <tr>
                            <td>Credit:</td>
                            <td><span class="word-rental-money">{{ $users->credit }}</span></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><span class="word-rental-money">{{ $users->email }}</span></td>
                        </tr>
                        <tr>
                            <td>Số điện thoại:</td>
                            <td><span class="word-rental-money">{{ $users->phone }}</span></td>
                        </tr>
                        <tr>
                            <td>Số căn cước công dân:</td>
                            <td><span class="word-rental-money">{{ $users->cccd }}</td>
                        </tr>
                        <tr>
                            <td>Ngày đăng ký:</td>
                            <td><span class="word-rental-money">{{ $users->created_at }}</span></td>
                        </tr>
                        <tr>
        <form action="" method="POST" enctype="multipart/form-data" >

       
                                <td>Số tài khoản: </td>
                                <td>
                                    @if (!$users->stk)
                                    <span class="word-rental-money">Chưa cung cấp</span>
                                    @else
                                    <span class="word-rental-money">{{ $users->stk }}</span>
                                    @endif
                                    
                                </td>
                        </tr>
                        <tr>
                            <td>Ngân hàng: </td>
                            <td>
                                @if (!$users->bank_name)
                                <span class="word-rental-money">Chưa cung cấp</span>
                                @else
                                <span class="word-rental-money">{{ $users->bank_name }}</span>
                                @endif
                            </td>
                        </tr>

                    </table>
                </h4>
            </div>

        </div>
        <div class="col">
            <h4>
                
                <div>
                    @php
                        use App\Models\SubRental;
                        // $averageCarStar = SubRental::where('id_car', $rentalcar->id)->avg('carstar');
                        $averageUserStar = SubRental::where('id_dealer', $users->id)->avg('userstar');
                        // $carRater = SubRental::where('id_car', $rentalcar->id)->where('carstar', '!=', null)->count();
                        //  $userRater = SubRental::where('id_car', $rentalcar->id)->count();
                    @endphp
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
                        
                        <span class="word-white">{{ round($averageUserStar, 1) }}</span>
                        
                        {{-- @if (!empty($sub->carstar)) --}}
                            {{-- <h6 class="word-white">{{ $userRater }} đánh giá</h6> --}}
                        {{-- @endif --}}
                        
                        
                    </div>
                </div>
            </h4>
            <h4>Chứng thực:
                {{-- @if ($users->status == 1)
                    <span class="word-green"><i class='fa fa-check'></i></span>
                @else
                    <span class="word-red"><i class='fa fa-x'></i></span>
                @endif --}}
                <form method="POST" action="{{ route('admin.userstatus.toggle', $users->id) }}">
                    @csrf
                    @if ($users->status == 1)
                    <span class="word-green"><i class='fa fa-check'></i></span>
                        <button type="submit" class="btn btn-warning">Hủy chứng thực</button>
                    @else
                    <span class="word-red"><i class='fa fa-x'></i></span>
                    <button type="submit" class="btn btn-success">Chứng thực</button>
                    @endif
                </form>

            </h4>
            <h4>Ảnh Căn cước công dân:</h4>
            @if (!$users->cccd_image)
            <span class="word-rental-money">Chưa cung cấp</span>
            @else
                <div class="container-flex">

                    <img  src="{{ asset('storage/' . $users->cccd_image) }}"
                        class=" rounded imagecccd cover object2">
                </div>
            @endif

            <h4>Ảnh Bằng lái:</h4>
            @if (!$users->licence_image)
            <span class="word-rental-money">Chưa cung cấp</span>
            @else
                <div class="container-flex">
                    <img  src="{{ asset('storage/' . $users->licence_image) }}"
                        class=" rounded imagecccd cover object2">
                </div>
            @endif
        </div>
    </div>
    <hr class="text-white">
    {{-- <p class="word-ash d-flex justify-content-center bg-rentalcard rounded p-1"> <i class='fa fa-warning'
            style='color: #f3da35'></i>&nbsp;
        Khuyến khích bổ sung các thông tin như ảnh bằng lái, căn cước, thông tin ngân hàng
        để được chứng thực và mở khóa chức năng cho thuê và thuê xe.</p> --}}

    {{-- <div class="d-flex justify-content-center m-2">
        <button type="submit" title="Thêm mới" class="btn btn-primary bg-rentalcard m-3 ">
            <h3><i class='fa fa-save'></i> Lưu lại</h3>
        </button>
    </div> --}}
    @csrf
</form>
</div>
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <script>
        const containers = document.querySelectorAll('.container');

        // Lặp qua từng container và áp dụng hiệu ứng hover riêng lẻ
        containers.forEach((container) => {
            const image = container.querySelector('.image');
            const imagecccd = container.querySelector('.imagecccd');
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
@endsection
