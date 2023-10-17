<?php

namespace App\Http\Controllers;

use App\Models\Transmission;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UserRequest;
use App\Models\FavoriteRental;
use Illuminate\Support\Facades\Validator;
use App\Rules\Uppercase;
use App\Models\Models;
use App\Models\Rentalcar;
use App\Models\RentalImage;


use Illuminate\Support\Facades\DB;

//  use DB;

class HomeController extends Controller
{
    public $data = [];
    private $rentalcar;
    const _PER_PAGE = 2;
    private $transmission;
    private $rental_image;
    public function __construct(){
        $this->rentalcar = new Rentalcar();
        $this->rental_image = New RentalImage();
        $this->transmission = New Transmission();
    }
    
    public function index(Request $request){
        $this->data['title'] = 'Timoto - Trang chủ';
        $title = 'Kết quả tìm kiếm';
        $ketqua = 'Kết quả cho:';
        $makebu = null;
        $provincebu = null;
        $modelbu = null;
        $bodytypebu = null;
        $drivetrainbu = null;
        $transmissionbu = null;
        $fuelbu = null;
        $filters = [];
        $keywords = null;
        $favorite = null;

        if (!empty($request->id_make)){
           $idMake = $request->id_make; 
           $filters[] =  ['rentalcar.id_make', '=', $idMake];
       }

       if (!empty($request->id_model)){
           $idModel = $request->id_model; 
           $filters[] =  ['rentalcar.id_model', '=', $idModel];
       }

       if (!empty($request->id_bodytype)){
           $idBodyType = $request->id_bodytype; 
           $filters[] =  ['rentalcar.id_bodytype', '=', $idBodyType];
       }

       if (!empty($request->id_province)){
           $idProvince = $request->id_province; 
           $filters[] =  ['rentalcar.id_province', '=', $idProvince];
       }

       if (!empty($request->id_drivetrain)){
           $idDrivetrain = $request->id_drivetrain; 
           $filters[] =  ['rentalcar.id_drivetrain', '=', $idDrivetrain];
       }

       if (!empty($request->id_fuel)){
           $idFuel = $request->id_fuel; 
           $filters[] =  ['rentalcar.id_fuel', '=', $idFuel];
       }

       if (!empty($request->id_transmission)){
           $idTransmission = $request->id_transmission; 
           $filters[] =  ['rentalcar.id_transmission', '=', $idTransmission];
           }

        if (!empty($request->keywords)){
            $keywords = $request->keywords;
        }

       

        $sortBy = $request->input('sort-by');
        
        $sortType = $request->input('sort-type')?$request->input('sort-type'):'asc'; 

        $allowSort = ['asc', 'desc'];

        if(!empty($sortType)&&in_array($sortType, $allowSort, $sortBy)){
            if($sortType == 'desc'){
                        $sortType = 'asc';
            }else{
                        $sortType = 'desc';
             } 
        }else{
            $sortType = 'asc';
        }

        
        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];
        $imagelist = $this->rental_image->getAllImage();
        
        $rentalcarList = $this->rentalcar->getAllRental($filters, $keywords, $sortArr, self::_PER_PAGE); 
        

        return view('clients.home', compact('title', 'ketqua', 'rentalcarList', 'sortType', 'imagelist'));
    }
    public function searchMaster(Request $request){
    
         $title = 'Kết quả tìm kiếm';
         $ketqua = 'Kết quả cho:';
         $makebu = null;
         $provincebu = null;
         $modelbu = null;
         $bodytypebu = null;
         $drivetrainbu = null;
         $transmissionbu = null;
         $fuelbu = null;
         $filters = [];
         $keywords = null;
         $favorite = null;

         if (!empty($request->id_make)){
            $idMake = $request->id_make; 
            $filters[] =  ['rentalcar.id_make', '=', $idMake];
        }

        if (!empty($request->id_model)){
            $idModel = $request->id_model; 
            $filters[] =  ['rentalcar.id_model', '=', $idModel];
        }

        if (!empty($request->id_bodytype)){
            $idBodyType = $request->id_bodytype; 
            $filters[] =  ['rentalcar.id_bodytype', '=', $idBodyType];
        }

        if (!empty($request->id_province)){
            $idProvince = $request->id_province; 
            $filters[] =  ['rentalcar.id_province', '=', $idProvince];
        }

        if (!empty($request->id_drivetrain)){
            $idDrivetrain = $request->id_drivetrain; 
            $filters[] =  ['rentalcar.id_drivetrain', '=', $idDrivetrain];
        }

        if (!empty($request->id_fuel)){
            $idFuel = $request->id_fuel; 
            $filters[] =  ['rentalcar.id_fuel', '=', $idFuel];
        }

        if (!empty($request->id_transmission)){
            $idTransmission = $request->id_transmission; 
            $filters[] =  ['rentalcar.id_transmission', '=', $idTransmission];
            }
 
         if (!empty($request->keywords)){
             $keywords = $request->keywords;
         }

        
 
         $sortBy = $request->input('sort-by');
         
         $sortType = $request->input('sort-type')?$request->input('sort-type'):'asc'; 
 
         $allowSort = ['asc', 'desc'];
 
         if(!empty($sortType)&&in_array($sortType, $allowSort, $sortBy)){
             if($sortType == 'desc'){
                         $sortType = 'asc';
             }else{
                         $sortType = 'desc';
              } 
         }else{
             $sortType = 'asc';
         }
 
         
         $sortArr = [
             'sortBy' => $sortBy,
             'sortType' => $sortType
         ];
         $imagelist = $this->rental_image->getAllImage();
         
         $rentalcarList = $this->rentalcar->getAllRental($filters, $keywords, $sortArr); 
         
         return view('clients.rental.rentallist', compact('title', 'ketqua', 'rentalcarList', 'sortType', 'imagelist'));
     }

    //  public function selectProvince(Request $request){
    //     $province = $request->selectedValue;
    //     $district = DB::table('tbl_district')->Where('id_province', $province)->get();
    //     return response()->json($district);
    // } 

     public function selectModel(Request $request){
        $make = $request->selectedValue;
        $model = DB::table('model')->Where('id_make', $make)->get();
        return response()->json($model);
    } 
     public function allFavor(Request $request){
        $title = 'Xe thuê đã thích';
        $filters = [];
        $keywords = null;
        $favorite = null;

        if (!empty($request->id_make)){
           $idMake = $request->id_make; 
           $filters[] =  ['rentalcar.id_make', '=', $idMake];
       }

       if (!empty($request->id_model)){
           $idModel = $request->id_model; 
           $filters[] =  ['rentalcar.id_model', '=', $idModel];
       }

       if (!empty($request->id_bodytype)){
           $idBodyType = $request->id_bodytype; 
           $filters[] =  ['rentalcar.id_bodytype', '=', $idBodyType];
       }

       if (!empty($request->id_province)){
           $idProvince = $request->id_province; 
           $filters[] =  ['rentalcar.id_province', '=', $idProvince];
       }
       


        if (!empty($request->keywords)){
            $keywords = $request->keywords;
        }

        $sortBy = $request->input('sort-by');
        
        $sortType = $request->input('sort-type')?$request->input('sort-type'):'asc'; 

        $allowSort = ['asc', 'desc'];

        if(!empty($sortType)&&in_array($sortType, $allowSort, $sortBy)){
            if($sortType == 'desc'){
                        $sortType = 'asc';
            }else{
                        $sortType = 'desc';
             } 
        }else{
            $sortType = 'asc';
        }

        
        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];
        $imagelist = $this->rental_image->getAllImage();
        
        $rentalcarList = $this->rentalcar->getAllRentalFavo($filters, $keywords, $sortArr); 
        return view('clients.rental.rentallist', compact('title', 'rentalcarList', 'sortType', 'imagelist'));
     }
   

    public function products(){
        $this->data['title'] = 'San pham';

        return view('clients.product', $this->data);
    }

    public function getAdd(){
        $this->data['errorMessage'] = 'Kiểm tra lại dữ liệu'; 
        $this->data['title'] = 'Thêm Sản Phẩm';
        return view('clients.add', $this->data);
    }

    public function postAdd(ProductRequest $request){
     
        //  $rules = [
        //     'product_name' => ['required','min:6', function($attribute, $value, $fail){
        //         $this->isUppercase($value, 'Trường :attribute không hợp lệ', $fail);
        //     }],
            
        //     'product_price' => ['required','integer', new Uppercase]
        // ]; validate kieu nay duoc su dung truoc khi bi jquery thay the nhu ben duoi

        $rules = [
            'product_name' => ['required','min:6'],
            
            'product_price' => ['required','integer']
        ];
      

        //   $messages = [
        //     'product_name.required' => 'Tên sản phẩm bắt buộc phải nhập',
        //     'product_name.min' => 'Tên sản phẩm không được nhỏ hơn :min ký tự',
        //     'product_price.required' => 'Giá sản phẩm bắt buộc phải nhập',
        //     'product_price.integer' => 'Giá sản phẩm phải là số'
        // ];

         $messages = [
            'required' => 'Trường :attribute bắt buộc phải nhập',
             'min' => 'Trường :attribute không được nhỏ hơn :min ký tự',
             'integer' => 'Trường :attribute phải là số',
            // 'uppercase' => 'Trường :attribute phải viết hoa'
         ]; 

        $attributes = [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm'
        ];

        // $Validator = Validator::make($request->all(), $rules, $messages, $attributes);

        // $Validator->validate();

        //$request->validate($rules, $messages);

        return response()->json(['status'=>'success']);
        // $Validator->validate();

        // if($Validator->fails()){
        //     $Validator->errors()->add('msg', 'Kiểm tra lại các trường nhập liệu');
        // }else{
        //     return redirect()->route('product')->with('msg', 'Validate thành công');
        // }
       
        // return back()->withErrors($Validator);

       

        
        
        // $request->validate($rules, $messages);
        //Xử lý việc thêm dữ liệu vào database
    }

    public function putAdd(Request $request){
        dd($request);
    }

    public function getArr(){
        $contentArr = [
            'name' => 'laravel 8x',
            'lesson' => 'khóa học lập trình laravel',
            'academy' => 'Unicode Academy'
        ];
        return $contentArr;
    }

    public function downloadImage(Request $request){
        if(!empty($request->image)){
            $image = trim($request -> image);   

             $fileName = 'image-'.uniqid().'.jpg';

            //$fileName = basename($image);


            // return response()->streamDownload(function() use ($image){
            //     $imageContent = file_get_contents($image);
            //     echo $imageContent;
            // }, $filename);

            return response()->download($image, $fileName);
        }
    }

    public function downloadDoc(Request $request){
        if(!empty($request->file)){
            $file = trim($request -> file);   

             $fileName = 'tai-lieu'.uniqid().'.pdf';

            //$fileName = basename($image);


            // return response()->streamDownload(function() use ($image){
            //     $imageContent = file_get_contents($image);
            //     echo $imageContent;
            // }, $filename);
            $headers = [
                'Content-Type' => 'application/pdf'
            ];

            return response()->download($file, $fileName, $headers);
        }
    }

    public function isUppercase($value, $message, $fail){
        if ($value!=mb_strtoupper($value, 'UTF-8')){
            $fail($message);
        }
    }
}
