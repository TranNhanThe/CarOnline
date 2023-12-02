<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Sellcar extends Model
{
    use HasFactory;
    protected $table = 'sellcar';
    protected $primaryKey = 'id';
    public function getAllSell($filters = [],  $keywords = null, $sortByArr = null, $perPage = null){
        //too raw
     // $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
     //DB::enableQueryLog();

     $now = now();

     $sellcar = DB::table($this->table)
     ->select('sellcar.*', 
     'users.fullname as user_name',
     'model.name as model_name',
     'fuel.name as fuel_name',
     'drivetrain.name as drivetrain_name', 
     'transmission.name as transmission_name',
     'bodytype.name as bodytype_name',
     'make.name as make_name',
     'province.name as province_name',
     'sell_image.link as image_link',
      
      // 'favorite_rental.id_frentalcar as id' 
     )
      ->join('users', 'sellcar.id_user', '=', 'users.id')
      ->join('model', 'sellcar.id_model', '=', 'model.id')
      ->join('fuel', 'sellcar.id_fuel', '=', 'fuel.id')
      ->join('drivetrain', 'sellcar.id_drivetrain', '=', 'drivetrain.id')
      ->join('transmission', 'sellcar.id_transmission', '=', 'transmission.id')
      ->join('bodytype', 'sellcar.id_bodytype', '=', 'bodytype.id')
      ->join('make', 'sellcar.id_make', '=', 'make.id')
      ->join('province', 'sellcar.id_province', '=', 'province.id')
   ->join('sell_image', 'sellcar.id', '=', 'sell_image.id_sellcar')
     ->where('sellcar.trash', 0)
      ->where('sell_image.is_main', 1)   
     ; 
     $orderBy = 'sellcar.id';
     $orderType = 'desc';
     

     if(!empty($sortByArr) && is_array($sortByArr)){
         if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
             $orderBy = trim($sortByArr['sortBy']);
             $orderType = trim($sortByArr['sortType']);        
         } 
     }

     $sellcar = $sellcar->orderBy($orderBy, $orderType);
     

     if(!empty($filters)){
         $sellcar = $sellcar->where($filters);
     }

    

     if(!empty($keywords)){
         $sellcar = $sellcar->where(function($query) use ($keywords){
             $query->orWhere('car_name', 'like', '%'.$keywords.'%');
             $query->orWhere('location', 'like', '%'.$keywords.'%');
             $query->orWhere('sellcar.id', 'like', '%'.$keywords.'%');
             $query->orWhere('car_name', 'like', '%'.$keywords.'%');
           $query->orWhere('province.name', 'like', '%'.$keywords.'%');
           $query->orWhere('rentalcar.id', 'like', '%'.$keywords.'%');
           $query->orWhere('users.fullname', 'like', '%'.$keywords.'%');
           $query->orWhere('users.fullname', 'like', '%'.$keywords.'%');
         });                     
     }

    // $users = $users->get(); 

    //phân trang
     if(!empty($perPage)){
         $sellcar = $sellcar->paginate($perPage)->withQueryString();
     
     }else{
      $sellcar = $sellcar->get();
     }
     

  //    $sql = DB::getQueryLog();
  //    //dd($lists);
  //    dd($sql);

     return $sellcar;
  }
}
