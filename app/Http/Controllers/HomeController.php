<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;
use App\Rules\Uppercase;

use Illuminate\Support\Facades\DB;

//  use DB;

class HomeController extends Controller
{
    public $data = [];
    public function index(){
        $this->data['title'] = 'dao tao lap trinh web';
        $this->data['message'] = 'Đăng ký tài khoản thành công';

        // $user = DB::select('SELECT * FROM users WHERE email=:email', [
        //     'email' => 'hoangan.web@gmail.com'
        // ]);

        // dd($user);

        return view('clients.home', $this->data);
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
