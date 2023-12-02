<?php

namespace App\Http\Controllers;

use App\Models\Rentalcar;

use App\Models\RentalImage;
use App\Models\Make;
use App\Models\Bodytype;
use App\Models\Models;
use App\Models\Drivetrain;
use App\Models\Fuel;
use App\Models\Province;
use App\Models\Transmission;
use App\Models\Users;
use App\Models\Utilities;
use Illuminate\Http\Request;
use App\Http\Requests\RentalRequest;
use App\Http\Requests\AdrentRequest;
use App\Http\Requests\ReAdrentRequest;
use App\Http\Requests\SubRequest;
use App\Http\Requests\UserRequest;
use App\Models\Ad_rent;
use App\Models\AdType;
use App\Models\SubRental;
use Attribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RentalController extends Controller
{
    private $rentalcar;
    private $adtype;
    private $rental_image;

    private $users;
    const _PER_PAGE_SIZE = 4;
    const _PER_PAGE = 10;

    public function __construct(){
        $this->rentalcar = new Rentalcar();
        $this->adtype = new AdType();
        $this->rental_image = New RentalImage();
        $this->users = New Users();
    }

    public function index(Request $request){
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

        

        $rentalcarList = $this->rentalcar->getAllRental($filters, $keywords, $sortArr, self::_PER_PAGE); 
        $imagelist = $this->rental_image->getAllImage();
        return view('clients.rental.rentallist', compact('title', 'rentalcarList', 'sortType', 'imagelist'));
    }
    public function yoretaca(Request $request){
        $title = 'Kho xe của bạn';
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
        
        $rentalcarList = $this->rentalcar->getAllRentalcarOfUser($filters, $keywords, $sortArr, self::_PER_PAGE); 
        return view('clients.rental.rentallist', compact('title', 'rentalcarList', 'sortType', 'imagelist'));
     }

    public function getImagesForCar($id)
{
    $car = RentalCar::find($id);

    if ($car) {
        $images = $car->rentalImages;
        return view('clients.rental.rentallist', ['images' => $images]);
    } else {
        // Xử lý trường hợp không tìm thấy xe
    }
}

    public function add(){
    $title = 'Thêm xe thuê';
        
     $allUser = getAllUsers(); 
     $allModel = getAllModels();
     $allFuel = getAllFuel();
     $allProvince = getAllProvince();
     $allMake = getAllMake();
     $allBodytype = getAllBodytype();
     $allTransmission = getAllTransmission();
     $allDrivetrain = getAllDrivetrain();
     return view('clients.rental.add', compact('title', 'allUser', 'allModel',
      'allFuel', 'allDrivetrain', 'allTransmission', 'allBodytype', 'allMake', 'allProvince'));
    }

    public function ad_add($id){
        $title = 'Đăng tin cho thuê xe';
        $rentalcar = Rentalcar::find($id);
         $allUser = getAllUsers(); 
        $allAdtype = getAllAdtype();
         return view('clients.rental.ad_add', compact('title', 'rentalcar', 'allUser',  'allAdtype'));
        }
        public function ad_readd($id){
            $title = 'Gia hạn tin đăng thuê xe';
            $rentalcar = Rentalcar::find($id);
             $allUser = getAllUsers(); 
            $allAdtype = getAllAdtype();
             return view('clients.rental.ad_readd', compact('title', 'rentalcar', 'allUser',  'allAdtype'));
            }
    public function postAdd(RentalRequest $request){
        

        $rentalcar = new Rentalcar();

        $rentalcar->id_user = auth()->user()->id;

        $rentalcar->car_name = $request->input('car_name');
        $rentalcar->id_model = $request->input('id_model');
        $rentalcar->id_fuel = $request->input('id_fuel');
        $rentalcar->id_drivetrain = $request->input('id_drivetrain');
        $rentalcar->id_transmission = $request->input('id_transmission');
        $rentalcar->id_bodytype = $request->input('id_bodytype');
        $rentalcar->id_make = $request->input('id_make');
        $rentalcar->location = $request->input('location');
        $rentalcar->id_province = $request->input('id_province');
        $rentalcar->engine = $request->input('engine');
        $rentalcar->exterior_color = $request->input('exterior_color');
        $rentalcar->interior_color = $request->input('interior_color');
        $rentalcar->vin = $request->input('vin');
        $rentalcar->no_accident = $request->input('no_accident');
        $rentalcar->bsx = $request->input('bsx');
        // $rentalcar->price = str_replace(['.', ','], '', $request->input('price'));
        // $rentalcar->price = $request->input('price');
        $rentalcar->seat = $request->input('seat');
        $rentalcar->driver = $request->input('driver');
        $rentalcar->mota = $request->input('mota');
        $rentalcar->save();
        $firstImage = true;

        $ad_rent = new Ad_rent();
        $ad_rent->id_rentalcar = $rentalcar->id;
        $ad_rent->save();

        $utilities = new Utilities();


        $utilities->camera_lui = $request->input('camera_lui');
        $utilities->dinh_vi_gps = $request->input('dinh_vi_gps');
        $utilities->etc = $request->input('etc');
        $utilities->Bluetooth = $request->input('Bluetooth');
        $utilities->cam_bien_lop = $request->input('cam_bien_lop');
        $utilities->khe_cam_usb = $request->input('khe_cam_usb');
        $utilities->tui_khi_an_toan = $request->input('tui_khi_an_toan');
        $utilities->camera_hanh_trinh = $request->input('camera_hanh_trinh');
        $utilities->canh_bao_toc_do = $request->input('canh_bao_toc_do');
        $utilities->lop_du_phong = $request->input('lop_du_phong');
        $utilities->camera_cap_le = $request->input('camera_cap_le');
        $utilities->cua_so_troi = $request->input('cua_so_troi');
        $utilities->cam_bien_va_cham = $request->input('cam_bien_va_cham');
        $utilities->camera_360 = $request->input('camera_360');
        $utilities->ghe_tre_em = $request->input('ghe_tre_em');
        $utilities->man_hinh_dvd = $request->input('man_hinh_dvd');
        $utilities->ban_do = $request->input('ban_do');
        $utilities->id_rentalcar = $rentalcar->id;
        $utilities->save();
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
            $imagePath = $image->store('rental_image', 'public');
    
            $rentalimg = new RentalImage();
            $rentalimg->link = $imagePath;
            $rentalimg->id_rentalcar = $rentalcar->id; // Gán giá trị khóa ngoại
    
    
            if ($firstImage) {
                $rentalimg->is_main = true;
                $firstImage = false; // Đánh dấu rằng đã tìm thấy ảnh đầu tiên
            }
    
            $rentalimg->save();
            }
        }

        return redirect()->route('rental.yoretaca')->with('msg', 'Thêm xe thành công');
    }

    public function postAd_add(AdrentRequest $request, $id){
        //  dd($request->all());
       $total = $request->input('total');
        $data = [
            'credit' => Auth::user()->credit - $total // Sửa $request->$total thành $total
        ];
        $iduser = Auth::id();
    
        Users::where('id', $iduser)->update($data);
        $iduser = Auth::id();
        Ad_rent::where('id_rentalcar', $id)->delete();
       
        $ad_rent = new Ad_rent();
        $ad_rent->id_rentalcar = $id;
        $ad_rent->price = str_replace(['.', ','], '', $request->input('price'));
        $ad_rent->id_adtype = $request->input('id_adtype');
        $ad_rent->rentaldays = $request->input('rentaldays');
        // $ad_rent->expiration_date = $request->input('expiration_date');
        $ad_rent->save();
        $rentalcar = Rentalcar::find($id); // Truy cập xe thuê theo $id
if ($rentalcar) {
    $rentalcar->update(['status' => 1]); // Cập nhật trường status thành 1
}
        

        return redirect()->route('rental.yoretaca')->with('msg', 'Tin đăng của bạn đã vào danh sách chờ duyệt');
    }
   
    public function postAd_readd(ReAdrentRequest $request, $id){
        //   dd($request->all());

        $total = $request->input('total');
        $data = [
            'credit' => Auth::user()->credit - $total // Sửa $request->$total thành $total
        ];
        $iduser = Auth::id();
        Users::where('id', $iduser)->update($data);
        $iduser = Auth::id();
        Ad_rent::where('id_rentalcar', $id)->delete();
       
        $ad_rent = new Ad_rent();
        $ad_rent->id_rentalcar = $id;
        $ad_rent->price = str_replace(['.', ','], '', $request->input('price'));
        $ad_rent->id_adtype = $request->input('id_adtype');
        $ad_rent->rentaldays = $request->input('rentaldays');
        
        $ad_rent->expiration_date = now()->addDays($ad_rent->rentaldays);
        // $ad_rent->expiration_date = $request->input('expiration_date');
        $ad_rent->status = 1;
        $ad_rent->save();
        $rentalcar = Rentalcar::find($id); // Truy cập xe thuê theo $id
if ($rentalcar) {
    $rentalcar->update(['status' => 1]); // Cập nhật trường status thành 1
}
        

        return redirect()->route('rental.yoretaca')->with('msg', 'Tin đăng của bạn đã được gia hạn thành công');
    }


    public function credit(){
        $title = 'Thêm Credit';
        
         return view('clients.users.credit', compact('title'));
        }
        public function postCredit(Request $request, $id=0){
            $data = [
                'credit' => Auth::user()->credit + $request->credit
            ];
            $iduser = Auth::id();
        
        Users::where('id', $iduser)->update($data);
        return back()->with('msg', 'Thêm Credit thành công');
        }
public $data = [];
public function show(Request $request, $id)
{
    $rentalcar = Rentalcar::find($id);
        $title = 'Chi tiết xe thuê';
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
    if ($rentalcar) {
        
        $rentalcar->view_count = $rentalcar->view_count + 1;
        $rentalcar->save();
    }

    $rental_image = RentalImage::where('id_rentalcar', $id)->get();
    $make = Make::find($rentalcar->id_make);
    $model = Models::find($rentalcar->id_model);
    $bodytype = Bodytype::find($rentalcar->id_bodytype);
    $drivetrain = Drivetrain::find($rentalcar->id_drivetrain);
    $fuel = Fuel::find($rentalcar->id_fuel);
    $province = Province::find($rentalcar->id_province);
    $transmission = Transmission::find($rentalcar->id_transmission);
     $utilities = Utilities::where('id_rentalcar', $id)->get();
     $sub_rental = Subrental::where('id_car', $id)->get();
    // $ad_rent = Ad_rent::find($rentalcar->id);
    // $ad_rent = Ad_rent::find($rentalcar->$id);
    $ad_rent = Ad_rent::where('id_rentalcar', $id)->get();  
    // $ad_rent = Ad_rent::where('id_rentalcar', $rentalcar->$id);
    $users = Users::find($rentalcar->id_user);
    $newrentalcarList = $this->rentalcar->getNewRental($filters, $keywords, $sortArr, self::_PER_PAGE_SIZE);
    return view('clients.rental.rentalcar', compact('title', 'newrentalcarList'), [
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
        'ad_rent' => $ad_rent, 
        'sub_rental' => $sub_rental
    ]);
}

// public function postOne(Request $request)
// {
//     // dd($request->all());
    
//     $this->data['title'] = 'Yêu cầu thuê xe';
//     $sub_rental = new SubRental();
//     $sub_rental->received_date = $request->input('received_date');
//     $sub_rental->return_date = $request->input('return_date');
//     $sub_rental->days = $request->input('days');
//     $sub_rental->id_ad_rent = $request->input('id_ad_rent');
//     $sub_rental->id_user = $request->input('renter');
//     $sub_rental->total = $request->input('total');
//     $sub_rental->deposit = $request->input('deposit');
//     $sub_rental->payback = $request->input('payback');                                                                                                              
//     $sub_rental->thanhtoan = $request->input('pttt');
//     $sub_rental->id_car = $request->input('id_car');
//     $sub_rental->id_dealer = $request->input('id_dealer');
//     $sub_rental->save();
    
//     return redirect()->route('rental.yorental')->with('msg', 'Yêu cầu của bạn đã được gửi');
// }
public function postOne(SubRequest $request)
{
// dd($request->all());
    $data=$request->all();
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://127.0.0.1:8000/rental/yorental";
$vnp_TmnCode = "SK0KPZAM";//Mã website tại VNPAY 
$vnp_HashSecret = "NTQGYABJRFYVGMNDRXOPSWNRBDZSVLQQ"; //Chuỗi bí mật

$vnp_TxnRef = time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = "Thanh toán thuê";
$vnp_OrderType = "Thuê xe";
$vnp_Amount = ($data['total'] * 100);
$vnp_Locale = "VN";
$vnp_BankCode = "NCB";
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
);


if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}


//var_dump($inputData);
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array('code' => '00'
    , 'message' => 'success',
    'msg', 'Thêm Credit thành công'
    , 'data' => $vnp_Url);
    if (isset($_POST['redirect'])) {
       
    $this->data['title'] = 'Yêu cầu thuê xe';
    $sub_rental = new SubRental();
    $sub_rental->received_date = $request->input('received_date');
    $sub_rental->return_date = $request->input('return_date');
    $sub_rental->days = $request->input('days');
    $sub_rental->id_ad_rent = $request->input('id_ad_rent');
    $sub_rental->id_user = $request->input('renter');
    $sub_rental->total = $request->input('total');
    $sub_rental->deposit = $request->input('deposit');
    $sub_rental->payback = $request->input('payback');                                                                                                              
    $sub_rental->thanhtoan = $request->input('pttt');
    $sub_rental->id_car = $request->input('id_car');
    $sub_rental->id_dealer = $request->input('id_dealer');
    $sub_rental->save();
        return redirect()->away($vnp_Url)->with('msg', 'Yêu cầu của bạn đã được gửi');
        
    } else {
        echo json_encode($returnData);
    }
    
    

    
    
}

// public function yorental(){
//     $this->data['title'] = 'Chi Tiết Xe Thuê';
//     $imagelist = $this->rental_image->getAllImage();
        
//     $rentalcarList = $this->rentalcar->yorental($filters, $keywords, $sortArr); 
//     return view('clients.rental.yorental', compact('title', 'rentalcarList', 'sortType', 'imagelist'));
//     // return view('clients.rental.yorental', $this->data);
// }

public function yorental(Request $request){
    $title = 'Danh sách Yêu cầu & Xe bạn đang thuê';
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
    
    $rentalcarList = $this->rentalcar->yorental($filters, $keywords, $sortArr); 
    return view('clients.rental.yorental', compact('title', 'rentalcarList', 'sortType', 'imagelist'));
 }
 public function youDealer(Request $request){
    $title = 'Kênh cho thuê của bạn';
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
    
    $rentalcarList = $this->rentalcar->youDealer($filters, $keywords, $sortArr); 
    return view('clients.rental.yorental', compact('title', 'rentalcarList', 'sortType', 'imagelist'));
 }
 public function contract($id){
    $this->data['title'] = 'Hợp đồng thuê xe';
    $sub_rental = SubRental::find($id);
    $users = Users::find($sub_rental->id_user);
    $dealer = Users::find($sub_rental->id_dealer);
    $rentalcar = Rentalcar::find($sub_rental->id_car);
    $province = Province::find($rentalcar->id_province);
    return view('clients.rental.contract', [
        'sub_rental' => $sub_rental,
        'dealer' => $dealer,
        'rentalcar' => $rentalcar,
        'users' => $users,
        'province' => $province
    ], $this->data);
 }
 public function dealer($id){
    $this->data['title'] = 'Hợp đồng thuê xe';
    $sub_rental = SubRental::find($id);
    $users = Users::find($sub_rental->id_user);
    $dealer = Users::find($sub_rental->id_dealer);
    $rentalcar = Rentalcar::find($sub_rental->id_car);
    $province = Province::find($rentalcar->id_province);
    return view('clients.rental.contract', [
        'sub_rental' => $sub_rental,
        'dealer' => $dealer,
        'rentalcar' => $rentalcar,
        'users' => $users,
        'province' => $province
    ], $this->data);
 }

 public function toggleAgree($id_sub){

   // dd($id_sub->route()->middleware());
    $sub_rental = SubRental::where('id', $id_sub)->first(); // Lấy ra bản ghi cần thao tác
   
    if ($sub_rental) {
        if ($sub_rental->agree == '1') {
            $sub_rental->agree = '0';
            $message = 'Đã Hủy chấp nhận';
        } else {
            $sub_rental->agree = '1';
            $message = 'Đã chấp nhận';
        }

        $sub_rental->save(); // Lưu thay đổi

         return redirect()->back()->with('success', $message);
        // return redirect()->route('admin.rentalshow', ['id'=>$carId])->with('success', $message);
    } else {
        return redirect()->back()->with('error', 'Không tìm thấy');
    }

}
public function toggleGiven($id_sub){

    // dd($id_sub->route()->middleware());
     $sub_rental = SubRental::where('id', $id_sub)->first(); // Lấy ra bản ghi cần thao tác
    
     if ($sub_rental) {
         if ($sub_rental->given == '1') {
             $sub_rental->given = '0';
             $message = 'Đã hủy giao xe';
         } else {
             $sub_rental->given = '1';
             $message = 'Đã giao xe';
         }
 
         $sub_rental->save(); // Lưu thay đổi
 
          return redirect()->back()->with('success', $message);
         // return redirect()->route('admin.rentalshow', ['id'=>$carId])->with('success', $message);
     } else {
         return redirect()->back()->with('error', 'Không tìm thấy');
     }
 
 }

 public function toggleTake($id_sub){

    // dd($id_sub->route()->middleware());
     $sub_rental = SubRental::where('id', $id_sub)->first(); // Lấy ra bản ghi cần thao tác
    $rentalcar = Rentalcar::where('id', $sub_rental->id_car)->first();
     if ($sub_rental) {
         if ($sub_rental->take == '1') {
             $sub_rental->take = '0';
             $message = 'Đã hủy nhận xe';
         } else {
             $sub_rental->take = '1';
             $message = 'Đã nhận xe';
         }
        
        $rentalcar->rented = $rentalcar->rented + 1;

        $rentalcar->save();
 
         $sub_rental->save(); // Lưu thay đổi
 
          return redirect()->back()->with('success', $message);
         // return redirect()->route('admin.rentalshow', ['id'=>$carId])->with('success', $message);
     } else {
         return redirect()->back()->with('error', 'Không tìm thấy');
     }
 
 }
 public function toggleBack($id_sub){

    // dd($id_sub->route()->middleware());
     $sub_rental = SubRental::where('id', $id_sub)->first(); // Lấy ra bản ghi cần thao tác
    
     if ($sub_rental) {
         if ($sub_rental->back == '1') {
             $sub_rental->back = '0';
             $message = 'Đã hủy trả xe';
         } else {
             $sub_rental->back = '1';
             $message = 'Đã trả xe';
         }
         
         $sub_rental->save(); // Lưu thay đổi
 
          return redirect()->back()->with('success', $message);
         // return redirect()->route('admin.rentalshow', ['id'=>$carId])->with('success', $message);
     } else {
         return redirect()->back()->with('error', 'Không tìm thấy');
     }
 
 }
 public function toggleFinish($id_sub){

    // dd($id_sub->route()->middleware());
     $sub_rental = SubRental::where('id', $id_sub)->first(); // Lấy ra bản ghi cần thao tác
    
     if ($sub_rental) {
         if ($sub_rental->finish == '1') {
             $sub_rental->finish = '0';
             $message = 'Chưa hoàn thành';
         } else {
             $sub_rental->finish = '1';
             $message = 'Đã Hoàn thành chuyến đi';
         }
 
         $sub_rental->save(); // Lưu thay đổi
 
          return redirect()->back()->with('success', $message);
         // return redirect()->route('admin.rentalshow', ['id'=>$carId])->with('success', $message);
     } else {
         return redirect()->back()->with('error', 'Không tìm thấy');
     }
 
 }

 public function rating(Request $request, $id_sub){
    $sub_rental = SubRental::where('id', $id_sub)->first();
    $sub_rental->carstar = $request->carstar; 
    $sub_rental->userstar = $request->userstar; 
    $sub_rental->user_comment = $request->user_comment;
    $sub_rental->car_comment = $request->car_comment;
    $sub_rental->save();
    $message = 'Cảm ơn bạn đã đánh giá!';
    return redirect()->back()->with('success', $message);
 }

 public function userCheck(Request $request, $id_sub){
    // dd($request->all());
    $sub_rental = SubRental::where('id', $id_sub)->first();
    $sub_rental->user_check = '1';
    $sub_rental->save();
    $message = 'Cảm ơn quý khách';
    return redirect()->back()->with('success', $message);
 }
 public function dealerCheck(Request $request, $id_sub){
    // dd($request->all());
    $sub_rental = SubRental::where('id', $id_sub)->first();
    $sub_rental->dealer_check = '1';
    $sub_rental->save();
    $message = 'Chúc mừng bạn';
    return redirect()->back()->with('success', $message);
 }

}
