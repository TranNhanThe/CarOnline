<h1>Trang chu unicode</h1>
<h2>{{!empty(request()->keyword)?request()->keyword:'Khong co gi'}}</h2>
<div class="container">
    {!!$content!!}
</div>

<hr>
{{-- @for ($i=1; $i<=10; $i++)
    <p>Phan tu thu: {{$i}}</p>
@endfor --}}

{{-- 
@while ($index<=10)
   <p>phan tu thu: {{$index}}</p>
   @php
       $index++; 
   @endphp
        
@endwhile --}}
{{-- 
@foreach ($dataArr as $key => $item)
    <p>Phan tu: {{$item}} - {{}}</p>

@endforeach --}}

{{-- @forelse ($dataArr as $item)
    <p>Phan tu: {{$item}}</p>   
@empty
    <p>khong co phan tu nao</p>
@endforelse --}}

{{-- @if ($number>=10)
    <p>day la gia tri hop le</p>
    
        
    @else
       <p>gia tri khong hop le</p> 
  
@endif --}}
{{-- 
@if ($number<0)
    <p>so am</p>
    
        
    @elseif($number>=0 && $number<=5)
       <p>so nho</p> 
    @elseif($number>=5 && $number<=10)
        <p>so trung binh</p>
    @else()
        <p>so to</p>
@endif --}}
{{-- 
@switch($number)
    @case(1)
        <p>so thu nhat</p>
        @break
    @case(2)
    <p>so thu hai</p>
        @break
    @default
        <p>so con lai</p>
@endswitch --}}

{{-- @for ($i = 1; $i<=10; $i++)
@if ($i == 5)
@continue
@endif
    <p>phan tu: {{$i}}</p>
    @if ($i == 5)
        @break
    @endif
@endfor --}}

{{-- @php
    $number = 5; 
    if ($number>=10) {
        $total = $number + 20;  
    }else{
        $total = $number + 10;
    }
      
@endphp

<h3>Ket qua: {{$number}} - {{$total}}</h3> --}}

@for ($index =0; $index<10; $index++)
<p>Phan tu: {{$index}}</p>
@endfor

{{-- @verbatim
<div class="container">
    Hello, {{className}}
</div>

<script>
    Hi, {{age}}
    hello, @{{name}}
</script>
@endverbatim --}}
{{-- @php
    $message = 'Dat hang thanh cong';   
@endphp --}}


@include('parts.notice')