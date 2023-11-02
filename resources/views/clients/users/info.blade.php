@extends('layouts.kclient')
@section('title')
    {{ $title }}
@endsection

@section('content')
@if (session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
    <div class="row word-white">
        <div class="col d-flex justify-content-center">
            <div>
                <h3>Họ và Tên: <span class="word-rental-money">{{ auth()->user()->fullname }}</span></h3>
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            <div>
                <h3>ID Timoto: <span class="word-rental-money">{{ auth()->user()->id }}</span></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col d-flex justify-content-center">
            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle avatar-image-xl">
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
                            <td><span class="word-rental-money">{{ auth()->user()->credit }}</span> <span class=""><a
                                        class="rounded back-green-custom" href="{{ route('rental.credit') }}"><i
                                            class='fa fa-plus'></i></a></span></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><span class="word-rental-money">{{ auth()->user()->email }}</span></td>
                        </tr>
                        <tr>
                            <td>Số điện thoại:</td>
                            <td><span class="word-rental-money">{{ auth()->user()->phone }}</span></td>
                        </tr>
                        <tr>
                            <td>Số căn cước công dân:</td>
                            <td><span class="word-rental-money">{{ auth()->user()->cccd }}</td>
                        </tr>
                        <tr>
                            <td>Ngày đăng ký:</td>
                            <td><span class="word-rental-money">{{ auth()->user()->created_at }}</span></td>
                        </tr>
                        <tr>
        <form action="" method="POST" enctype="multipart/form-data" >

       
                                <td>Số tài khoản: </td>
                                <td><input type="text" class="word-ash bg-rentalcard" name="stk" id="stk"
                                        value="{{ auth()->user()->stk }}"> <label for="stk"><span title="Có thể sửa"
                                            class="word-red"><i class='fa fa-pencil'></i></span></label></td>
                        </tr>
                        <tr>
                            <td>Ngân hàng: </td>
                            <td><input type="text" class="word-ash bg-rentalcard" name="bank_name" id="bank"
                                    value="{{ auth()->user()->bank_name }}"> <label for="bank"><span title="Có thể sửa"
                                        class="word-red"><i class='fa fa-pencil'></i></span></label></td>
                        </tr>

                    </table>
                </h4>
            </div>

        </div>
        <div class="col">
            <h4>
                <div>
                    @php
                        $rating = auth()->user()->user_star; // Đây là giá trị xếp hạng thực tế
                        $fullStars = floor($rating); // Số sao đầy
                        $halfStar = $rating - $fullStars >= 0.5; // Xem xét có hiển thị nửa sao không
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
                        <span class="word-white">{{ auth()->user()->user_star }}</span>
                    </div>
                </div>
            </h4>
            <h4>Chứng thực:
                @if (auth()->user()->status == 1)
                    <span class="word-green"><i class='fa fa-check'></i></span>
                @else
                    <span class="word-red"><i class='fa fa-x'></i></span>
                @endif

            </h4>
            <h4>Ảnh Căn cước công dân:</h4>
            @if (!auth()->user()->cccd_image)
                <input class="text-bg form-control" type="file" name="cccd_image" accept="image/*">
            @else
                <div class="container-flex">

                    <img  src="{{ asset('storage/' . auth()->user()->cccd_image) }}"
                        class=" rounded imagecccd cover object2">


                    <div>
                        <input class="text-bg form-control" title="Chọn ảnh khác" type="file" name="cccd_image"
                            accept="image/*">
                    </div>
                </div>
            @endif

            <h4>Ảnh Bằng lái:</h4>
            @if (!auth()->user()->licence_image)
                <input class="text-bg form-control" type="file" name="licence_image"  accept="image/*">
            @else
                <div class="container-flex">

                    <img  src="{{ asset('storage/' . auth()->user()->licence_image) }}"
                        class=" rounded imagecccd cover object2">


                    <div>
                        <input class="text-bg form-control" title="Chọn ảnh khác" type="file" name="licence_image"
                             accept="image/*">
                    </div>
                </div>
            @endif
        </div>
    </div>
    <hr class="text-white">
    <p class="word-ash d-flex justify-content-center bg-rentalcard rounded p-1"> <i class='fa fa-warning'
            style='color: #f3da35'></i>&nbsp;
        Khuyến khích bổ sung các thông tin như ảnh bằng lái, căn cước, thông tin ngân hàng
        để được chứng thực và mở khóa chức năng cho thuê và thuê xe.</p>

    <div class="d-flex justify-content-center m-2">
        <button type="submit" title="Thêm mới" class="btn btn-primary bg-rentalcard m-3 ">
            <h3><i class='fa fa-save'></i> Lưu lại</h3>
        </button>
    </div>
    @csrf
</form>
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
