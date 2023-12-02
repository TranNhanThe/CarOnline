<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sellcar;
use App\Models\Users;
use App\Models\Make;
use App\Models\Bodytype;
use App\Models\Models;
use App\Models\Drivetrain;
use App\Models\Fuel;
use App\Models\Province;
use App\Models\Transmission;
use App\Models\SellImage;
use App\Models\Sell_utilities;
class SellController extends Controller
{

    private $sellcar;
    private $users;
    private $sell_image;
    const _PER_PAGE_SIZE = 4;
    const _PER_PAGE = 10;

    public function __construct(){
        $this->sellcar = new Sellcar();
        
        // $this->rental_image = New RentalImage();
        $this->users = New Users();
    }
    public function index(Request $request){
        //$statement = $this->users->statementUser("DELETE FROM users");
         
         $title = 'Danh sách xe bán';
 
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
 
             $filters[] =  ['sellcar.status', '=', $status];
 
      
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
         $sellcarList = $this->sellcar->getAllSell($filters, $keywords, $sortArr, self::_PER_PAGE); 
        //  $imagelist = $this->sell_image->getAllImage();
         return view('clients.sell.selllist', compact('title', 'sellcarList', 'sortType'));
     }

     public function show(Request $request, $id)
{
    $sellcar = Sellcar::find($id);
        $title = 'Chi tiết xe bán';
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
    if ($sellcar) {
        
        $sellcar->view_count = $sellcar->view_count + 1;
        $sellcar->save();
    }

    $sell_image = SellImage::where('id_sellcar', $id)->get();
    $make = Make::find($sellcar->id_make);
    $model = Models::find($sellcar->id_model);
    $bodytype = Bodytype::find($sellcar->id_bodytype);
    $drivetrain = Drivetrain::find($sellcar->id_drivetrain);
    $fuel = Fuel::find($sellcar->id_fuel);
    $province = Province::find($sellcar->id_province);
    $transmission = Transmission::find($sellcar->id_transmission);
    $users = Users::find($sellcar->id_user);
    $sell_utilities = Sell_utilities::where('id_sellcar', $id)->get();
    $newsellcarList = $this->sellcar->getAllSell($filters, $keywords, $sortArr, self::_PER_PAGE_SIZE);
    return view('clients.sell.sellcar', compact('title', 'newsellcarList'), [
        'sellcar' => $sellcar,
        'sell_image' => $sell_image,
        'make' => $make,
        'model' => $model,
        'bodytype' => $bodytype,
        'drivetrain' => $drivetrain,
        'fuel' => $fuel,
        'province' => $province,
        'transmission' => $transmission,
        'sell_utilities' => $sell_utilities,
        'users' => $users,
        // 'ad_rent' => $ad_rent, 
        // 'sub_rental' => $sub_rental
    ]);
}
}
