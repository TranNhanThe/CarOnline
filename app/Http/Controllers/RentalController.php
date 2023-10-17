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
use App\Http\Requests\UserRequest;
use App\Models\Ad_rent;
use App\Models\AdType;
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
        
        $rentalcarList = $this->rentalcar->getAllRentalcarOfUser($filters, $keywords, $sortArr); 
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
    $title = 'Thêm xe beta';
        
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

        return redirect()->route('rental.index')->with('msg', 'Thêm xe thành công');
    }

    public function postAd_add(AdrentRequest $request, $id){
       
        $iduser = Auth::id();
        Ad_rent::where('id_rentalcar', $id)->delete();
       
        $ad_rent = new Ad_rent();
        $ad_rent->id_rentalcar = $id;
        $ad_rent->price = str_replace(['.', ','], '', $request->input('price'));
        $ad_rent->id_adtype = $request->input('id_adtype');
        $ad_rent->expiration_date = $request->input('expiration_date');
        $ad_rent->save();
        $rentalcar = Rentalcar::find($id); // Truy cập xe thuê theo $id
if ($rentalcar) {
    $rentalcar->update(['status' => 1]); // Cập nhật trường status thành 1
}
        

        return redirect()->route('rental.yoretaca')->with('msg', 'Tin đăng của bạn đã vào danh sách chờ duyệt');
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
    // public function postCredit(UserRequest $request){
    //     $id = Auth::id();
            
    //         if (!$request->has('credit') || !is_numeric($request->credit)) {
    //             return back()->with('msg', 'Dữ liệu không hợp lệ');
    //         }
            
    //         $data = [
    //             'users.credit' => $request->credit + Auth::user()->credit
    //         ];
    //         // $this->users->updateUser($data, $id);
        
    //         return DB::table($this->users)->where('id', $id)->update($data);
    //         // return back()->with('msg', 'Cập nhật người dùng thành công');
    // }


    // public $data = [];
    // public function detail() {
    //     $this->data['title'] = 'Chi Tiết Xe Thuê';
    //     return view('clients.rental.rentalcar', $this->data);
    // }
//     public function getCarDetail(Request $request, $id=0){
        
//         $title = 'Chi Tiết Xe Thuê';

//         if (!empty($id)){
//             $rentalcarDetail = $this->rentalcar->getDetail($id);
//             if(!empty($rentalcarDetail[0])){
//                 $request->session()->put('id', $id);
//                 $rentalcarDetail = $rentalcarDetail[0];
//             }else{
//                 return redirect()->route('rental.index')->with('msg', 'Nguời dùng không tồn tại');
//             }
//         }else{
//             return redirect()->route('rental.index')->with('msg', 'Liên kết không tồn tại');
//         }
//         // $allGroups = getAllGroups();
//         $allUser = getAllUsers(); 
//         $allModel = getAllModels();
//         $allFuel = getAllFuel();
//         $allProvince = getAllProvince();
//         $allMake = getAllMake();
//         $allBodytype = getAllBodytype();
//         $allTransmission = getAllTransmission();
//         $allDrivetrain = getAllDrivetrain();

//         return view('clients.rental.rentalcar', compact('title', 'rentalcarDetail', 'allUser', 'allModel',
//         'allFuel', 'allDrivetrain', 'allTransmission', 'allBodytype', 'allMake', 'allProvince'));
    
         
// }
public $data = [];
public function show($id)
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
    return view('clients.rental.rentalcar', [
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
   
   
}
