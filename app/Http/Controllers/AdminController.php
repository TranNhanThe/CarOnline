<?php

namespace App\Http\Controllers;
use App\Models\Rentalcar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\RentalImage;
use Illuminate\Support\Facades\DB;



use App\Models\Make;
use App\Models\Bodytype;
use App\Models\Models;
use App\Models\Drivetrain;
use App\Models\Fuel;
use App\Models\Province;
use App\Models\Transmission;

use App\Models\Utilities;


use App\Models\Ad_rent;

class AdminController extends Controller
{
    private $users;
    private $rentalcar;

    private $rental_image;
    public $data = [];
    const _PER_PAGE = 10;
    public function __construct(){
        $this->users = new Users();
        $this->rentalcar = new Rentalcar();
        $this->rental_image = New RentalImage();
    }
    public function index(Request $request)
    {
        $title = 'Danh sách người dùng';
        
       // $this->users->learnQueryBuilder();
        $filters = [];
        $keywords = null;
        if (!empty($request->status)){
            $status = $request->status; 
            if ($status == 'active'){
                $status = 1;
            }else{
                $status = 0;
            }

            $filters[] =  ['users.status', '=', $status];

     
        }
        if (!empty($request->group_id)){
            $groupId = $request->group_id; 
            $filters[] =  ['users.group_id', '=', $groupId];
        }

        if (!empty($request->keywords)){
            $keywords = $request->keywords;
             
        }

        //Xử lý logic sắp xếp

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

        $usersList = $this->users->getAllUsers($filters, $keywords, $sortArr, self::_PER_PAGE); 
        return view('Admin.index', compact('title', 'usersList', 'sortType'));


        
        // return view('Admin.index', $this->data);
    }

    public function rentallist(Request $request){
        //$statement = $this->users->statementUser("DELETE FROM users");
         
         $title = 'Danh sách xe thuê';
 
        // $this->users->learnQueryBuilder();
         $filters = [];
         $keywords = null;
         if (!empty($request->status)){
             $status = $request->status; 
             if ($status == 'active'){
                 $status = 1;
             }else{
                 $status = 0;
             }
 
             $filters[] =  ['rentalcar.status', '=', $status];
 
      
         }
         // if (!empty($request->group_id)){
         //     $groupId = $request->group_id; 
         //     $filters[] =  ['users.group_id', '=', $groupId];
         // }
 
         if (!empty($request->keywords)){
             $keywords = $request->keywords;
              
         }
 
         //Xử lý logic sắp xếp
 
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
 
         
 
         $rentalcarList = $this->rentalcar->getAllRentalAd($filters, $keywords, $sortArr, self::_PER_PAGE); 
         $imagelist = $this->rental_image->getAllImage();
         return view('admin.rentallist', compact('title', 'rentalcarList', 'sortType', 'imagelist'));
     }
    public function getEdit(Request $request, $id=0){
        
        $title = 'Cập nhật người dùng';

        if (!empty($id)){
            $userDetail = $this->users->getDetail($id);
            if(!empty($userDetail[0])){
                $request->session()->put('id', $id);
                $userDetail = $userDetail[0];
            }else{
                return redirect()->route('users.index')->with('msg', 'Nguời dùng không tồn tại');
            }
        }else{
            return redirect()->route('users.index')->with('msg', 'Liên kết không tồn tại');
        }
$allGroups = getAllGroups();
        return view('admin.useredit', compact('title', 'userDetail', 'allGroups'));
    
         
}

public function postEdit(Request $request, $id=0){
    $id = session('id');
    if (empty($id)){
        return back()->with('msg', 'Liên kết không tồn tại');
    }
    $dataUpdate =[
        'fullname' => $request->fullname,
        'email' => $request->email,
        'status' => $request->status,
        'updated_at' => date('Y-m-d H:i:s' )
    ];
    $this->users->updateUser($dataUpdate, $id);

    return back()->with('msg','Cập nhật người dùng thành công');
}

public function delete($id=0){
    if (!empty($id)){
        $userDetail = $this->users->getDetail($id);
        if(!empty($userDetail[0])){
           $deleteStatus = $this->users->deleteUSer($id);
           if($deleteStatus){
                $msg = 'Xóa người dùng thành công';
           }else{
                $msg = 'Bạn không thể xóa người dùng lúc này. Vui lòng thử lại sau';
           }
        }else{
            $msg = 'Người dùng không tồn tại';
        }
    }else{
        $msg = 'Liên kết không tồn tại ';
    }

    return redirect()->route('admin.home')->with('msg', $msg);
}
    
    public function adminlogin()
    {
        $this->data['title'] = 'Đăng Nhập';
        return view('Admin.login', $this->data);
    }

    public function adminloginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credetials)) {
            $user = Auth::user();
            if ($user->is_admin == 1) {
            return redirect('admin/')->with('success', 'Login Success');
        }
        return redirect('/rental')->with('success', 'Login Success');
        }
 
        return back()->with('error', 'Đăng nhập thất bại');
    }

    
public function rentalshow($id)
{
    $this->data['title'] = 'Chi Tiết Xe Thuê';
    $rentalcar = Rentalcar::find($id);
    $rental_image = RentalImage::where('id_rentalcar', $id)->get();
    $make = Make::find($rentalcar->id_make);
    $model = Models::find($rentalcar->id_model);
    $bodytype = Bodytype::find($rentalcar->id_bodytype);
    $drivetrain = Drivetrain::find($rentalcar->id_drivetrain);
    $fuel = Fuel::find($rentalcar->id_fuel);
    $province = Province::find($rentalcar->id_province);
    $transmission = Transmission::find($rentalcar->id_transmission);
    $utilities = Utilities::find($rentalcar->id_transmission);
    // $ad_rent = Ad_rent::find($rentalcar->id);
    // $ad_rent = Ad_rent::find($rentalcar->$id);
    $ad_rent = Ad_rent::where('id_rentalcar', $id)->get();  
    // $ad_rent = Ad_rent::where('id_rentalcar', $rentalcar->$id);
    $users = Users::find($rentalcar->id_user);
    return view('admin.rentalcar', [
        'rentalcar' => $rentalcar,
        'rental_image' => $rental_image,
        'make' => $make,
        'model' => $model,
        'bodytype' => $bodytype,
        'drivetrain' => $drivetrain,
        'fuel' => $fuel,
        'province' => $province,
        'transmission' => $transmission,
        'utilities' => $utilities,
        'users' => $users,
        'ad_rent' => $ad_rent
    ], $this->data,);
}

// public function toggleStatus($carId)
// {
//     $car = Ad_rent::where('id_rentalcar', $carId);

//     if($car->status == '1') {
//         $car->status = '0';
//         return redirect()->back()->with('message', 'Đã xóa khỏi danh sách yêu thích'); 
//     }else{
//         $car->status = '1';
//         return redirect()->back()->with('message', 'Đã thêm vào danh sách yêu thích');
//     }
// }

public function toggleStatus($carId)
{
    $car = Ad_rent::where('id_rentalcar', $carId)->first(); // Lấy ra bản ghi cần thao tác

    if ($car) {
        if ($car->status == '1') {
            $car->status = '0';
            $message = 'Đã xóa khỏi danh sách yêu thích';
        } else {
            $car->status = '1';
            $car->expiration_date = now()->addDays($car->rentaldays);
            $message = 'Đã thêm vào danh sách yêu thích';
        }

        $car->save(); // Lưu thay đổi

        return redirect()->back()->with('message', $message);
    } else {
        return redirect()->back()->with('error', 'Không tìm thấy xe yêu thích');
    }
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
    
    $rentalcarList = $this->rentalcar->getAllRentalAd($filters, $keywords, $sortArr, self::_PER_PAGE); 
    
    return view('admin.rentallist', compact('title', 'ketqua', 'rentalcarList', 'sortType', 'imagelist'));
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
}


