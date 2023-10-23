@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('content')
    <h1 class="word-ash">{{$title}}</h1>
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    
    <a href="{{route('users.add')}}" class="btn btn-primary">Thêm người dùng</a>
    <hr>

    <form action="" method="get" class="mb-3">
        <div class="row">
            <div class="col-3">
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
            </div>
            <div class="col-4">
                <input type="search" name="keywords" value="{{request()->keywords}}" class="form-control" placeholder="Từ khóa tìm kiếm...">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-block" >Tìm kiếm</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered word-ash">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th><a href="?sort-by=fullname&sort-type={{$sortType}}">Tên</a></th>
                <th><a href="?sort-by=email&sort-type={{$sortType}}">Email</a></th>
                {{-- <th>Nhóm</th> --}}
                <th>Trạng thái</th>
                <th width="15%"><a href="?sort-by=created_at&sort-type={{$sortType}}">Thời Gian</a></th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($usersList))
                @foreach ($usersList as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->fullname}}</td>
                <td>{{$item->email}}</td>
                {{-- <td>{{$item->group_name}}</td> --}}
                <td>{!!$item->status==0?'<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>':
                '<button class="btn btn-success btn-sm">kích hoạt</button>'!!}</td>
                <td>{{$item->created_at}}</td>
                <td><a href="{{route('users.edit', ['id'=>$item->id])}}" class="btn btn-warning btn-sm">Sửa</a></td>
                <td><a onclick="return confirm('Xóa thật à?')" href="{{route('users.delete',['id'=>$item->id] )}}" class="btn btn-danger btn-sm">Xóa</a></td>
            </tr>
                @endforeach
            @else 
            <tr>
                <td colspan="4">Không có người dùng</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-end">{{$usersList->links()}}</div>
    
@endsection