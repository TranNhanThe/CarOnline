@extends('layouts.kclient')
@section('title')
    {{$title}}
@endsection

@section('content')
<h3 class="word-ash mid">{{$title}}</h3>

<form action="{{route('rental.post-credit')}}" method="POST" enctype="multipart/form-data">
    <div class="row justify-content-center">
        <div class="col-7">
             @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
        </div>
       
        <div class="col-7">
            <table class="table table-bordered word-ash">
        <thead>
            <tr>
                <th>Giá</th>
                <th>Credit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="200" name="credit" id="1">
                        <label class="form-check-label" for="1">
                            <h6>20.000 vnđ</h6>
                        </label>
                    </div>
                </td>
                <td>
                    Credit x 200
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="500" name="credit" id="2">
                        <label class="form-check-label" for="2">
                            <h6>50.000 vnđ</h6>
                        </label>
                    </div>
                </td>
                <td>
                    Credit x 500
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1000" name="credit" id="3">
                        <label class="form-check-label" for="3">
                            <h6>100.000 vnđ</h6>
                        </label>
                    </div>
                </td>
                <td>
                    Credit x 1000
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="2000" name="credit" id="4">
                        <label class="form-check-label" for="4">
                            <h6>200.000 vnđ</h6>
                        </label>
                    </div>
                </td>
                <td>
                    Credit x 2000
                </td>
            </tr>

            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="5000" name="credit" id="5">
                        <label class="form-check-label" for="5">
                            <h6>500.000 vnđ</h6>
                        </label>
                        @error('credit')
                  <span style="color: red;">{{$message}}</span>
                  @enderror
                    </div>
                </td>
                <td>
                    Credit x 5000
                </td>
            </tr>
        </tbody>
     </table>

     <div class="row justify-content-center ">
       
        <div class="col-3">
            <button type="submit" title="Thanh toán"  class="btn back-green mid"> Thanh toán</button>
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