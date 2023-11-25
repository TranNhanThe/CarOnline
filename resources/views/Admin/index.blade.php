@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
    
@section('content')
<h1 class="word-ash mid"><i class='fa fa-address-card-o'></i>&nbsp;{{$title}}</h1>
@if (session('msg'))
    <div class="alert alert-success">{{session('msg')}}</div>
@endif

{{-- <a href="{{route('users.add')}}" class="btn btn-primary">Thêm người dùng</a> --}}
<hr>

<form action="" method="get" class="mb-3">
    <div class="row d-flex justify-content-center">
        {{-- <div class="col-3">
            <select class="form-control" name="status">
                <option value="0">Tất cả trạng thái</option>
                <option value="active" {{request()->status=='active'?
                'selected':false}}>Kích hoạt</option>
                <option value="inactive" {{request()->status=='inactive'?
                    'selected':false}}>Chưa kích hoạt</option>
            </select>
        </div>
        <div class="col-3">
            <select class="form-control" name="group_id">
                <option value="0">Tất cả nhóm</option>
                @if (!empty(getAllGroups()))
                    @foreach (getAllGroups() as $item)
                        <option value="{{$item->id}}"{{request()->group_id==$item->id?
                            'selected':false}}>{{$item->name}}</option>                           
                    @endforeach
                @endif
            </select>
        </div> --}}
        <div class="col-4">
            <input type="search" name="keywords" value="{{request()->keywords}}" class="form-control" placeholder="Từ khóa, id, tên, email, phone, cccd,...">
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary btn-block" >Tìm kiếm</button>
        </div>
    </div>
</form>
<table class="table table-bordered ">
    <thead>
        <tr class="word-white">
            <th width="5%">STT</th>
            <th><a href="?sort-by=id&sort-type={{$sortType}}">ID</a></th>
            <th><a href="?sort-by=fullname&sort-type={{$sortType}}">Tên User - @php
                $count = DB::table('users')->count();
                echo $count;
            @endphp  User </a></th>
            <th><a href="?sort-by=credit&sort-type={{$sortType}}">Credit</a></th>
            <th><a href="?sort-by=email&sort-type={{$sortType}}">Email</a></th>
            <th>Phone</th>
            <th>CCCD</th>
            <th>Star</th>
            <th>Trạng thái</th>
            <th width="15%"><a href="?sort-by=created_at&sort-type={{$sortType}}">Thời Gian</a></th>
            <th>Chi tiết</th>
            <th width="5%">Sửa</th>
            <th width="5%">Xóa</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($usersList))
            @foreach ($usersList as $key => $item)
        <tr class="word-ash">
            <td>{{$key+1}}</td>
            <td>{{$item->id}}</td>
            <td>{{$item->fullname}}</td>
            <td>{{$item->credit}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->phone}}</td>
            <td>{{$item->cccd}}</td>
            @php
            
            // $averageCarStar = SubRental::where('id_car', $rentalcar->id)->avg('carstar');
            $averageUserStar = \App\Models\SubRental::where('id_dealer', $item->id)->avg('userstar');
            // $carRater = SubRental::where('id_car', $rentalcar->id)->where('carstar', '!=', null)->count();
            //  $userRater = SubRental::where('id_car', $rentalcar->id)->count();
        @endphp
            <td>{{$averageUserStar}}</td>
            <td>{!!$item->status==0?'<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>':
            '<button class="btn btn-success btn-sm">kích hoạt</button>'!!}</td>
            <td>{{$item->created_at}}</td>
            <td><a href="{{route('admin.userinfo', ['id'=>$item->id])}}" class="btn btn-info btn-sm">Xem</a></td>
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
<div class="d-flex justify-content-center">{{$usersList->links()}}</div>
@endsection