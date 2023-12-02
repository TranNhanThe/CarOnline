@extends('layouts.admin')
@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h3 class="word-white mid">{{ $title }}</h3>
    {{-- <hr>
    <h2 class="word-white">{{ $sub_rental->id }}</h2>
    <h2 class="word-white">{{ $users->fullname }}</h2>
    <h2 class="word-white">{{ $users->email }}</h2>
    <h2 class="word-white">{{ $users->phone }}</h2>
    <h2 class="word-white">{{ $users->cccd }}</h2>
    <hr>
    <h2 class="word-white">{{ $dealer->fullname }}</h2>
    <h2 class="word-white">{{ $dealer->email }}</h2>
    <h2 class="word-white">{{ $dealer->phone }}</h2>
    <h2 class="word-white">{{ $dealer->cccd }}</h2> 
    <hr>
    <h2 class="word-white">{{ $rentalcar->car_name }}</h2>
    <hr> --}}

    <hr>
<div class="container">
    <div class="row justify-content-center p-3">

        <div class="col-9 bg-white p-4 rounded">
            <div class="mid bg-rentalcard"> <img src="{{ asset('assets/clients/images/logotimotopj.png') }}" height="87px" width="150px" 
                class="rounded img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt=""></div>
            <br>
                <h4 class="mid">Hợp đồng thuê: {{ $rentalcar->car_name }}</h4>
            <hr>
            <h3 class=""><i class='fa fa-user'></i> Thông tin cá nhân</h3>
            <div class="row justify-content-center container">
                <div class="col-6 ">
                    <h4 class="">Bên thuê</h4>
                    <br>
                    <h5 class="">Tên: {{ $users->fullname }}</h5>
                    <h5 class="">Email: {{ $users->email }}</h5>
                    <h5 class="">Di động: {{ $users->phone }}</h5>
                </div>
                <div class="col-6 ">
                    <h4 class="">Bên cho thuê</h4>
                    <br>
                    <h5 class="">Tên: {{ $dealer->fullname }}</h5>
                    <h5 class="">Email: {{ $dealer->email }}</h5>
                    <h5 class="">Di động: {{ $dealer->phone }}</h5>
                </div>
            </div>
            <hr>
            <h3 class=""><i class='fa fa-car'></i> Thông tin xe</h3>
            <div class="row justify-content-center container">

                <div class="col-6 ">

                    <h5 class="">Tên: {{ $rentalcar->car_name }}</h5>
                    <h5 class="">Biển kiểm soát: {{ $rentalcar->bsx }}</h5>
                    <h5 class="">Địa chỉ: {{ $rentalcar->location }}, {{ $province->name }}</h5>
                </div>
                <div class="col-6 ">

                    <h5 class="">Đã từng va chạm:
                        @if ($rentalcar->no_accident == 1)
                            Rồi
                        @else
                            Chưa
                        @endif
                    </h5>
                    <h5 class="">Kèm tài xế:
                        @if ($rentalcar->driver == 1)
                            có
                        @else
                            không
                        @endif
                    </h5>

                </div>



            </div>
            <hr>
            <h3 class="">Thuê {{ $sub_rental->days }} ngày</h3>
            <div class="row justify-content-center container">
                <div class="col-5">
                    <h5><table>
                        <tr>
                            <td>Ngày nhận:</td>
                            <td>&nbsp; {{ \Carbon\Carbon::parse($sub_rental->received_date)->format('d-m-20y') }}</td>
                        </tr>
                        <tr>
                            <td>Ngày trả:</td>
                            <td>&nbsp; {{ \Carbon\Carbon::parse($sub_rental->return_date)->format('d-m-20y') }}</td>
                        </tr>
                    </table></h5>
                    

                </div>
                <div class="col-7">
                    @php
                        $dichvu = $sub_rental->days * 50000;
                        $baohiem = $sub_rental->days * 70000;
                        $thunhap = ($sub_rental->total-$sub_rental->deposit-$dichvu-$baohiem) / 100 * 90;
                        $hoahong = ($sub_rental->total-$sub_rental->deposit-$dichvu-$baohiem) / 100 * 10;
                    @endphp
                    <h5><table>
                        <tr class="word-black">
                            <td>Số tiền: </td>
                            <td>&nbsp; {{ number_format($sub_rental->total, 0, ',', '.') }}</td>
                            <td>&nbsp; vnđ</td>
                            
                        </tr>
                        <tr class="word-black">
                            <td>Tiền cọc: </td>
                            <td>&nbsp; {{ number_format($sub_rental->deposit, 0, ',', '.') }}</td>
                            <td>&nbsp; vnđ</td>
                            <td><form method="post" action="{{ route('admin.depo.toggle', $sub_rental->id) }}">
                                @csrf
                                @method('POST') <!-- Sử dụng POST method -->
                            
                            
                                @if ($sub_rental->depo == 1)
                                    <button type="submit" disabled  class="btn btn-success">Đã hoàn </button>
                                @else
                                <button type="submit"  class="btn btn-warning">Hoàn tiền</button>
                                @endif
                                
                            </form></td>
                        </tr>
                        <tr class="word-black">
                            <td>Phí dịch vụ: </td>
                            <td>&nbsp; {{ number_format($dichvu, 0, ',', '.') }} </td>
                            <td>&nbsp; vnđ</td>
                        </tr>
                        <tr class="word-black">
                            <td>Phí bảo hiểm: </td>
                            <td>&nbsp; {{ number_format($baohiem, 0, ',', '.') }} </td>
                            <td>&nbsp; vnđ</td>
                        </tr>
                        <tr class="word-black">
                            <td>Thu nhập 90%: </td>
                            <td>&nbsp; {{ number_format($thunhap, 0, ',', '.') }} </td>
                            <td>&nbsp; vnđ</td>
                            <td>
                                <form method="post" action="{{ route('admin.pay.toggle', $sub_rental->id) }}">
                                    @csrf
                                    @method('POST') <!-- Sử dụng POST method -->
                                
                                
                                    @if ($sub_rental->pay == 1)
                                        <button type="submit" disabled  class="btn btn-success">Đã hoàn</button>
                                    @else
                                    <button type="submit"  class="btn btn-warning">Hoàn tiền</button>
                                    @endif
                                    
                                </form>
                            </td>
                        </tr>
                        <tr class="word-black">
                            <td>Hoa hồng 10%: </td>
                            <td>&nbsp; {{ number_format($hoahong, 0, ',', '.') }}</td>
                            <td>&nbsp; vnđ</td>
                        </tr>
                    </table></h5>
                    
                </div>

            </div>
            <hr>
            <div class="row bg-rentalcard rounded justify-content-center container p-1">
                <div class="col-12 ">
                    <li class="word-ash">
                        Nếu đến ngày nhận mà chủ xe chưa đồng ý cho thuê và giao xe thì hợp đồng sẽ tự hủy.
                        Timoto sẽ liên hệ với người thuê để hoàn tiền.
                    </li>
                    <li class="word-ash">
                        Trường hợp muốn gia hạn xe thì người thuê và chủ xe nên liên hệ với nhau.
                        Nếu chủ xe chấp nhận thì tạo một hợp
                        đồng mới và tiếp tục thuê xe.
                    </li>
                    <li class="word-ash">
                        Tiền cọc sẽ được Timoto hoàn trả lại cho người thuê sau khi hoàn tất thuê xe với điều kiện không có vấn đề gì xảy ra
                    </li>
                    <li class="word-ash">
                        Timoto sẽ chịu trách nhiệm bảo hiểm 50% số tiền đền bù hoặc sửa chữa nếu người thuê gây ra thiệt hại về xe.
                    </li>
                    <li class="word-ash">Nếu người thuê tự ý gia hạn một mình hoặc trả xe trễ N ngày thì phải trả đủ n
                        ngày đó
                        và chịu mất tiền cọc
                    </li>
                    <li class="word-ash">
                        Người nào thực hiện một trong các hành vi chiếm đoạt tài sản của người khác trị giá từ 200.000.000
                        đồng đến dưới 500.000.000 hoặc từ 500.000.000 đồng trở lên sẽ bị xử phạt vi phạm hành chính về hành
                        vi chiếm đoạt tài sản hoặc đã bị
                        kết án về tội này hoặc về một trong các tội quy định tại các
                        điều 168, 169, 170, 171, 172, 173, 174 và 290 của Bộ luật này, chưa được xóa án tích mà còn vi phạm
                        hoặc tài sản là phương tiện kiếm sống chính của người bị hại và gia đình họ, thì bị phạt tù từ 12
                        năm đến 20 năm.
                    </li>
                </div>

            </div>
            <br>
            ID hợp đồng: {{ $sub_rental->id }}
        </div>

        <div class="row justify-content-center p-3">
            <div class=" col-9 bg-rentalcard p-4 rounded">
                <div class="row">
                    <h3 class="word-white mid">
                        <i class='fa fa-gamepad'></i>&nbsp;Bảng Điều Khiển Thuê Xe
                    </h3>
                    <hr>
                    <table>
                        <tr>
                            {{-- <td>{!! $sub_rental->agree == 0
                                    ? '<button class="btn back-orange">Chưa Chấp thuận</button>'
                                    : '<button class="btn back-green">Đã chấp thuận</button>' !!}</td> --}}
                            @if ($sub_rental->id_dealer == auth()->user()->id)
                                <td>
                                    <form method="POST" action="{{ route('rental.agree.toggle', $sub_rental->id) }}">
                                        @csrf
                                        @if ($sub_rental->agree == 0)
                                            <button type="submit" class="btn back-orange">Chấp thuận</button>
                                        @else
                                            <button disabled type="submit" class="btn back-green">Đã chấp thuận</button>
                                        @endif
                                    </form>
                                </td>
                            @else
                                <td>{!! $sub_rental->agree == 0
                                    ? '<button disabled class="btn back-orange">Chưa Chấp thuận</button>'
                                    : '<button disabled class="btn back-green">Đã chấp thuận</button>' !!}</td>
                            @endif
                            {{-- --------------------------------------------------------------------- --}}
                            @if ($sub_rental->id_dealer == auth()->user()->id && $sub_rental->agree == 1)
                                <td>
                                    <form method="POST" action="{{ route('rental.given.toggle', $sub_rental->id) }}">
                                        @csrf
                                        @if ($sub_rental->given == 0)
                                            <button type="submit" class="btn back-orange">Giao xe</button>
                                        @else
                                            <button disabled type="submit" class="btn back-green">Đã giao xe</button>
                                        @endif
                                    </form>
                                </td>
                            @else
                                <td>{!! $sub_rental->given == 0
                                    ? '<button disabled class="btn back-orange">Chưa giao xe</button>'
                                    : '<button disabled class="btn back-green">Đã giao xe</button>' !!}</td>
                            @endif
                            {{-- --------------------------------------------------------------------- --}}
                            @if ($sub_rental->id_user == auth()->user()->id && $sub_rental->given == 1)
                                <td>
                                    <form method="POST" action="{{ route('rental.take.toggle', $sub_rental->id) }}">
                                        @csrf
                                        @if ($sub_rental->take == 0)
                                            <button type="submit" class="btn back-orange">Nhận xe</button>
                                        @else
                                            <button disabled type="submit" class="btn back-green">Đã nhận xe</button>
                                        @endif
                                    </form>
                                </td>
                            @else
                                <td>{!! $sub_rental->take == 0
                                    ? '<button disabled class="btn back-orange">Chưa nhận xe</button>'
                                    : '<button disabled class="btn back-green">Đã nhận xe</button>' !!}</td>
                            @endif
                            {{-- --------------------------------------------------------------------- --}}
                            @if ($sub_rental->id_user == auth()->user()->id && $sub_rental->take == 1)
                                <td>
                                    <form method="POST" action="{{ route('rental.back.toggle', $sub_rental->id) }}">
                                        @csrf
                                        @if ($sub_rental->back == 0)
                                            <button type="submit" class="btn back-orange">Trả xe</button>
                                        @else
                                            <button disabled type="submit" class="btn back-green">Đã trả xe</button>
                                        @endif
                                    </form>
                                </td>
                            @else
                                <td>{!! $sub_rental->back == 0
                                    ? '<button disabled class="btn back-orange">Chưa trả xe</button>'
                                    : '<button disabled class="btn back-green">Đã trả xe</button>' !!}</td>
                            @endif
                            {{-- --------------------------------------------------------------------- --}}
                            @if ($sub_rental->id_dealer == auth()->user()->id && $sub_rental->back == 1)
                                <td>
                                    <form method="POST" action="{{ route('rental.finish.toggle', $sub_rental->id) }}">
                                        @csrf
                                        @if ($sub_rental->finish == 0)
                                            <button type="submit" class="btn back-orange">Nhận lại xe</button>
                                        @else
                                            <button disabled type="submit" class="btn back-green">Đã Hoàn thành</button>
                                        @endif
                                    </form>
                                </td>
                            @else
                                <td>{!! $sub_rental->finish == 0
                                    ? '<button disabled class="btn back-orange">Chưa hoàn thành</button>'
                                    : '<button disabled class="btn back-green">Đã kết thúc</button>' !!}</td>
                            @endif
                            {{-- --------------------------------------------------------------------- --}}
                        </tr>

                    </table>
                    <br>
                    <hr class="mt-3">
                    @if ($sub_rental->id_user == auth()->user()->id && $sub_rental->finish == 1 &&  $sub_rental->userstar == null)
                    <h4 class="word-white mid">Đánh giá của bạn</h4>
                    <form method="POST" action="{{ route('rental.post-rating', $sub_rental->id) }}">
                        <h5 class="word-white">Dành cho chủ xe</h5>
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-4 col-sm-12 rating word-white">
                                <input type="radio" checked id="star5" name="userstar" value="5" />
                                <label for="star5" title="5 sao"></label>
                                <input type="radio" id="star4" name="userstar" value="4" />
                                <label for="star4" title="4 sao"></label>
                                <input type="radio" id="star3" name="userstar" value="3" />
                                <label for="star3" title="3 sao"></label>
                                <input type="radio" id="star2" name="userstar" value="2" />
                                <label for="star2" title="2 sao"></label>
                                <input type="radio" id="star1" name="userstar" value="1" />
                                <label for="star1" title="1 sao"></label>
                            </div>
                        </div>
                        <input type="hidden" id="ratingValue" name="ratingValue" value="0" />
                        <br>
                        <textarea name="user_comment" class="form-control" id="" cols="5" rows="3"
                            placeholder="Nhận xét cho chủ xe"></textarea>
                        <br>
                        <h5 class="word-white">Dành cho xe thuê</h5>

                        <div class="row">
                            <div class="col-12 col-lg-4 col-sm-12 rating word-white">
                                <input type="radio" checked id="starxe5" name="carstar" value="5" />
                                <label for="starxe5" title="5 sao"></label>
                                <input type="radio" id="starxe4" name="carstar" value="4" />
                                <label for="starxe4" title="4 sao"></label>
                                <input type="radio" id="starxe3" name="carstar" value="3" />
                                <label for="starxe3" title="3 sao"></label>
                                <input type="radio" id="starxe2" name="carstar" value="2" />
                                <label for="starxe2" title="2 sao"></label>
                                <input type="radio" id="starxe1" name="carstar" value="1" />
                                <label for="starxe1" title="1 sao"></label>
                            </div>
                        </div>
                        <input type="hidden" id="ratingValue" name="ratingValue" value="0" />
                        <br>
                        <textarea name="car_comment" class="form-control" id="" cols="5" rows="3"
                            placeholder="Nhận xét cho xe thuê"></textarea>
                        <br>
                        <div class="mid"><button class="btn back-green" type="submit">Đánh giá</button> </div>

                    </form>
                
                    <hr class="mt-3">
                    @endif
                    {{-- ----------------------------------------- --}}
                    @if ($sub_rental->id_user == auth()->user()->id && $sub_rental->finish == 1 && $sub_rental->user_check == 0 )
                        @if ($sub_rental->id_user == auth()->user()->id && $sub_rental->finish == 1 && $sub_rental->depo == 0)
                            <h4 class="alert alert-warning mid">Vui lòng chờ Timoto hoàn tiền cọc cho bạn</h4>
                        @elseif($sub_rental->id_user == auth()->user()->id && $sub_rental->finish == 1 && $sub_rental->depo == 1)
                            <h4 class="alert alert-success mid">Timoto đã chuyển tiền cọc lại cho bạn vui lòng kiểm tra tài
                                khoản! &nbsp;
                                <form method="POST" action="{{ route('rental.post-usercheck', $sub_rental->id) }}">
                                    @csrf
                                    <div class="mid"><button name="user_check" value="1" class="btn back-green"
                                            type="submit">Xác nhận</button></div>
                                </form>
                            </h4>
                        @endif
                    @elseif($sub_rental->id_user == auth()->user()->id && $sub_rental->finish == 1 && $sub_rental->user_check == 1)
                    <h4 class="alert alert-danger mid"><i class='fa fa-heart'></i>&nbsp;Chuyến đi đã hoàn thành Timoto cám ơn quý khách&nbsp; <i class='fa fa-heart'></i></h4>
                    @endif



                    @if ($sub_rental->id_dealer == auth()->user()->id && $sub_rental->finish == 1 && $sub_rental->pay == 0)
                        <h4 class="alert alert-warning mid">Vui lòng chờ Timoto chuyển tiền cho bạn</h4>
                    @elseif($sub_rental->id_dealer == auth()->user()->id && $sub_rental->finish == 1 && $sub_rental->pay == 1 && $sub_rental->dealer_check == 0)
                        <h4 class="alert alert-success mid">Timoto đã chuyển tiền cho bạn vui lòng kiểm tra tài khoản!
                            &nbsp;
                                <form method="POST" action="{{ route('rental.post-dealercheck', $sub_rental->id) }}">
                                    @csrf
                                    <div class="mid"><button name="dealer_check" value="1" class="btn back-green"
                                            type="submit">Xác nhận</button></div>
                                </form>
                        </h4>
                    @elseif($sub_rental->id_dealer == auth()->user()->id && $sub_rental->dealer_check == 1 && $sub_rental->pay == 1)
                    <h4 class="alert alert-danger mid"><i class='fa fa-heart'></i>&nbsp;Chuyến đi đã thành công Timoto chúc bạn một ngày tốt lành&nbsp; <i class='fa fa-heart'></i></h4>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.rating input');

            stars.forEach(function(star) {
                star.addEventListener('click', function() {
                    const ratingValue = this.value;
                    const defaultRating = 5;
                    document.getElementById('ratingValue').value = defaultRating;
                });
            });
        });
    </script>
@endsection
