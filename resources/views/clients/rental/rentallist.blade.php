@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('sidebar')
    @parent
    <h3 class="word-white">product sidebar</h3>
@endsection
@section('content')
    <h1 class="text-white">{{$title}}</h1>
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <a href="{{route('rental.add')}}" class="btn btn-primary">Thêm xe thuê</a>
    <hr>

    {{-- <form action="" method="get" class="mb-3">
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên xe</th>
                <th>Chủ xe</th>
                <th>Model</th>
                <th>Fuel</th>
                <th>DriveTrain</th>
                <th>Transmission</th>
                <th>Body</th>
                <th>Make</th>
                <th>Province</th>
                <th>image</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($rentalcarList))
                @foreach ($rentalcarList as $key => $item)
            <tr>
                <td>{{$item->car_name}}</td>
                <td>{{$item->user_name}}</td>
                <td>{{$item->model_name}}</td>
                <td>{{$item->fuel_name}}</td>
                <td>{{$item->drivetrain_name}}</td>
                <td>{{$item->transmission_name}}</td>
                <td>{{$item->bodytype_name}}</td>
                <td>{{$item->make_name}}</td>
                <td>{{$item->province_name}}</td>
                <td><p><img src="{{$item->image_link}}" width="100" alt=""></p></td>
            </tr>
                @endforeach
            @else 
            <tr>
                <td colspan="4">Không có xe</td>
            </tr>
            @endif
        </tbody>
    </table>

 


    <div class="d-flex justify-content-end">{{$rentalcarList->links()}}</div> --}}
    {{-- class="img-fluid" --}}
<div class="row">
    @if (!empty($rentalcarList))
    @foreach ($rentalcarList as $key => $item)
    {{-- <div class="container mb-3 col-12 col-md-12 col-lg-12 col-xl-4 "> --}}
        <div class="container mb-3 col-lg-6 col-md-6 col-sm-6 col-xxl-12">
        <div class="container">
        
            <div class=" bg-rentalcard rounded-open">
              
<div class="row">
    
                {{-- /////////////////////////////////image///////////////////////////// --}}
                <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xxl-5">

                    <div class="rounded-image-open container-flex">

                        {{-- <img src="public/storage/{{$item->image_link}}" class="image cover object" id="{{$item->id}}"> --}}
                        <a href="{{route('rental.show', ['id'=>$item->id])}}"><img src="storage/{{$item->image_link}}" class="image cover object" id="{{$item->id}}"></a>

                        <div class="middle" id="1{{$item->id}}">
                            <div class="text "><a class="word-white" href="{{route('rental.add')}}">Yêu thích</a></div>

                        </div>

                        <div class="toptop" id="2{{$item->id}}">

                            <div>

                                <img src="assets\clients\images\logotimotopj.png" 
                           
    class="rounded img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
    
                            </div>
                        </div>
                        {{-- assets\clients\images\kar.jpg --}}
                        {{-- height="200px" width="auto" --}}
                        {{-- {{$item->image_link}} --}}
                    </div>
                </div>
                {{-- /////////////////////////////////image-end///////////////////////////// --}}
                
                <div class="col-md-12  col-lg-12 col-xl-12 col-sm-12 col-xxl-7">
                    <div class="row container">
                        
                        <div class="col-md-9 col-sm-9">
                            <p class="my-1 word-ash-normal">{{ date('d-m-Y', strtotime($item->created_at)) }}</p>
                           <a href="{{route('rental.show', ['id'=>$item->id])}}"><h4 class="my-1 word-ash">{{$item->car_name}}</h4></a> 
                            <p class="my-1 word-rental-money">{{ number_format($item->price, 0, ',', '.') }} Đồng/ngày</p>
                            <p class="my-1 word-ash-normal"><i style="font-size: 20px" class='fa-solid fa-location-dot'></i> {{$item->location}}, {{$item->province_name}}</p>
                            {!!$item->driver==0?'<button class="btn btn-danger btn-sm">Không kèm tài xế</button>':
                '<button class="btn btn-success btn-sm">Có kèm tài xế</button>'!!}
                        </div>

                        <div class="col-md-3 col-sm-3  d-flex justify-content-end">

                           <div class="d-flex align-items-center justify-content-center">

                            <img src="assets\clients\images\rental.png" width="80%" height="auto" alt="" >
                        </div>
                            {{-- đã thuê n lần --}}
                           <div class="d-flex align-items-center justify-content-center"><h4 class="word-ash-normal"> : {{$item->rented}}</h4></div> 
                        </div>

                    </div>

                        <hr>

                    <div class="row container hidden-on-sm pb-3">
                        {{-- ghế --}}
                        <div class="col-md-4 col-sm-2">
                            <div class="rounded bg-rentalcard-in text-white pt-3" style="width: auto; height: auto;">
                                <div class="d-flex align-items-center justify-content-center"><img src="assets\clients\images\seat2.png" width="50px" alt=""></div>
                                <div class="d-flex align-items-center justify-content-center"><h5>{{$item->seat}}</h5></div>
                            </div>
                        </div>
                        {{-- hộp số --}}
                        <div class="col-md-4 col-sm-2">
                            <div class="rounded bg-rentalcard-in text-white pt-3" style="width: auto; height: auto;">  
                                <div class="d-flex align-items-center justify-content-center"><img src="assets\clients\images\gearboxpro.png" width="50px" alt=""></div>
                                <div class="d-flex align-items-center justify-content-center"><h6>{{$item->transmission_name}}</h6></div>
                            </div>
                        </div>
                        {{-- nhiên liệu --}}
                        <div class="col-md-4 col-sm-2">
                            <div class="rounded bg-rentalcard-in text-white pt-3" style="width: auto; height: auto">
                                <div class="d-flex align-items-center justify-content-center"><img src="assets\clients\images\fuel.png" width="50px" alt=""></div>
                                <div class="d-flex align-items-center justify-content-center"><h5>{{$item->fuel_name}}</h5></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
             
            
        </div>
        </div>
    </div>
    
    {{-- <div class="container">
        <img src="assets\clients\images\kar.jpg" alt="Avatar" class="image" id="{{$item->id}}" style="width:100%">
        <div class="middle" id="{{$item->id}}">
          <div class="text">John Doe</div>
        </div>
      </div> --}}

    
    
   
    @endforeach
    @else 
    <tr>
        <td colspan="4">Không có xe</td>
    </tr>
    @endif
</div>


    <script>
        const containers = document.querySelectorAll('.container');

// Lặp qua từng container và áp dụng hiệu ứng hover riêng lẻ
containers.forEach((container) => {
    const image = container.querySelector('.image');
    const middle = container.querySelector('.middle');
    const toptop = container.querySelector('.toptop');
    
    container.addEventListener('mouseenter', () => {
        image.style.opacity = '0.3';
        middle.style.opacity = '1';
        toptop.style.opacity = '1';
        
    });

    container.addEventListener('mouseleave', () => {
        image.style.opacity = '1';
        middle.style.opacity = '0';
        toptop.style.opacity = '0';
    });
});
</script>
    
@endsection