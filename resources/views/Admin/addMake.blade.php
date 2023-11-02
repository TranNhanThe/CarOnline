@extends('layouts.admin')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <h1 class="word-ash mid">{{ $title }}</h1>

    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach</div>
        
    @endif

    <div class="row flex-container">
        <div class="col-6">
            <div class="row rounded bg-rentalcard pt-4 p-2 m-2">
                <div class="col-3 word-white mt-2">
                    <h6><i class='fa fa-search'></i> Hãng - @php
                        $count = DB::table('make')->count();
                        echo $count;
                    @endphp   </h6>
                </div>
                <div class="col-7 ">
                    <form action="{{ route('admin.addMake') }}" method="get" class="mb-3">
                        <input type="search" name="keywords" value="{{ request()->keywords }}" class="form-control"
                            placeholder="Tên hãng">
                </div>
                
                <div class="col-1">
                    <button type="submit" class="btn text-search"><i class='fa fa-search'></i></button></form>
                </div>
            </div>
            {{-- ------------------- --}}
            <div class="row rounded bg-rentalcard p-2 m-2">
                <div class="col-3 word-white mt-2">
                    <h6>Thêm Hãng</h6>
                </div>
                <div class="col-7">
                    <form action="" method="POST">
                        <input type="text" class="form-control" name="name" placeholder="Tên Hãng"
                            value="{{ old('name') }}">
                        @error('name')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        @csrf

                </div>
                <div class="col-1">
                    <button type="submit" class="btn text-search"><i class='fa fa-plus'></i></button></form>
                </div>
            </div>

            <div class="row py-2">
                <div class="col">
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="word-white">
                                <th>STT</th>
                                <th><a href="addmake?sort-by=id&sort-type={{$sortType}}">ID</a></th>
                                <th>Tên Hãng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($makeList))
                                @foreach ($makeList as $key => $item)
                                    <tr class="word-ash">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">{{$makeList->links()}}</div>
                </div>
            </div>
        </div>
{{-- ---------------------------------------------------------------------- --}}
            {{-- --------work here-------- --}}
        <div class="col-6">
            <div class="row rounded bg-rentalcard pt-4 p-2 m-2">
                <div class="col-3 word-white mt-2">
                    <h6><i class='fa fa-search'></i> Model - @php
                        $count = DB::table('model')->count();
                        echo $count;
                    @endphp</h6>
                </div>
                <div class="col-3 ">
                    <form action="{{ route('admin.addMake') }}" method="get" class="mb-3">
                        <select class="form-select bg-rentalcard word-white" id="id_make" name="id_make">
                            <option value=""><i class='fas fa-car-alt'></i>Mọi Hãng</option>
                            @if (!empty(getAllMake()))
                                @foreach (getAllMake() as $item)
                                    <option
                                        value="{{ $item->id }}"{{ request()->id_make == $item->id ? 'selected' : false }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            @endif
                            <!-- Thêm các hãng xe khác vào đây -->
                        </select>
                </div>
                <div class="col-4">
                    <input type="search" name="keywordsi" value="{{ request()->keywordsi }}" class="form-control"
                            placeholder="Tên Model">
                </div>
                <div class="col-1 ">
                    <button type="submit" class="btn text-search"><i class='fa fa-search'></i></button></form>
                </div>
            </div>
            {{-- ---------------------------- --}}
            <div class="row d-flex rounded justify-content-center bg-rentalcard p-2 m-2">
                <div class="col-3 word-white mt-2">
                    <h6>Thêm Model</h6>
                </div>
                <div class="col-3">
                    <form action="{{ route('admin.addModel') }}" method="POST">
                        <select class="form-select bg-rentalcard word-white" id="id_make" name="id_make">
                            <option value=""><i class='fas fa-car-alt'></i>Mọi Hãng</option>
                            @if (!empty(getAllMake()))
                                @foreach (getAllMake() as $item)
                                    <option
                                        value="{{ $item->id }}"{{ request()->id_make == $item->id ? 'selected' : false }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            @endif
                            <!-- Thêm các hãng xe khác vào đây -->
                        </select>
                        @error('id_make')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-4">

                    <input type="text" class="form-control" name="name" placeholder="Tên Model"
                        value="{{ old('name') }}">
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror

                    @csrf

                </div>
                <div class="col-2">
                    <button type="submit" class="btn text-search"><i class='fa fa-plus'></i></button> </form>
                </div>
            </div>

            <div class="row py-2">
                <div class="col">
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="word-white">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên Model</th>
                                <th>Tên hãng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($modelList))
                                @foreach ($modelList as $key => $item)
                                    <tr class="word-ash">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->make_name }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">{{$modelList->links()}}</div>
                </div>
            </div>
        </div>

    </div>
@endsection
