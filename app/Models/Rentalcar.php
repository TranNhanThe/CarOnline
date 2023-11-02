<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class Rentalcar extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        // Các trường khác
    ];
    protected $table = 'rentalcar';
    protected $primaryKey = 'id';

    public function images()
    {
        return $this->hasMany(RentalImage::class, 'id_rentalcar');
    }

    public function getAllRentalAd($filters = [],  $keywords = null, $sortByArr = null, $perPage = null){

     $now = now();

     $rentalcar = DB::table($this->table)
     ->select('rentalcar.*', 
     'users.fullname as user_name',
     'model.name as model_name',
     'fuel.name as fuel_name',
     'drivetrain.name as drivetrain_name', 
     'transmission.name as transmission_name',
     'bodytype.name as bodytype_name',
     'make.name as make_name',
     'province.name as province_name',
     'rental_image.link as image_link',
     'ad_rent.status as ad_status',
     'ad_rent.id_adtype as adtype',
     'ad_rent.price as adprice',
     'ad_rent.expiration_date as expdate'
     
      
     )
      ->join('users', 'rentalcar.id_user', '=', 'users.id')
      ->join('ad_rent', 'rentalcar.id', '=', 'ad_rent.id_rentalcar')
      ->join('model', 'rentalcar.id_model', '=', 'model.id')
      ->join('fuel', 'rentalcar.id_fuel', '=', 'fuel.id')
      ->join('drivetrain', 'rentalcar.id_drivetrain', '=', 'drivetrain.id')
      ->join('transmission', 'rentalcar.id_transmission', '=', 'transmission.id')
      ->join('bodytype', 'rentalcar.id_bodytype', '=', 'bodytype.id')
      ->join('make', 'rentalcar.id_make', '=', 'make.id')
      ->join('province', 'rentalcar.id_province', '=', 'province.id')
      ->join('rental_image', 'rentalcar.id', '=', 'rental_image.id_rentalcar')
     ->where('rentalcar.trash', 0)
     ->where('rental_image.is_main', 1); 
     $orderBy = 'ad_rent.id';
     $orderType = 'asc';
     

     if(!empty($sortByArr) && is_array($sortByArr)){
         if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
             $orderBy = trim($sortByArr['sortBy']);
             $orderType = trim($sortByArr['sortType']);        
         } 
     }

     $rentalcar = $rentalcar->orderBy($orderBy, $orderType);
     

     if(!empty($filters)){
         $rentalcar = $rentalcar->where($filters);
     }

    

     if(!empty($keywords)){
         $rentalcar = $rentalcar->where(function($query) use ($keywords){
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
         $rentalcar = $rentalcar->paginate($perPage)->withQueryString();
     
     }else{
      $rentalcar = $rentalcar->get();
     }
     

  //    $sql = DB::getQueryLog();
  //    //dd($lists);
  //    dd($sql);

     return $rentalcar;
  }
    public function getAllRental($filters = [],  $keywords = null, $sortByArr = null, $perPage = null){
          //too raw
       // $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
       //DB::enableQueryLog();

       $now = now();

       $rentalcar = DB::table($this->table)
       ->select('rentalcar.*', 
       'users.fullname as user_name',
       'model.name as model_name',
       'fuel.name as fuel_name',
       'drivetrain.name as drivetrain_name', 
       'transmission.name as transmission_name',
       'bodytype.name as bodytype_name',
       'make.name as make_name',
       'province.name as province_name',
       'rental_image.link as image_link',
       'ad_rent.status as ad_status',
       'ad_rent.id_adtype as adtype',
       'ad_rent.price as adprice',
       'ad_rent.rentaldays as rentaldays',
       'ad_rent.expiration_date as expdate'
        
        // 'favorite_rental.id_frentalcar as id' 
       )
    //  ->join('groups', 'users.group_id', '=', 'groups.id')
        ->join('users', 'rentalcar.id_user', '=', 'users.id')
        ->join('ad_rent', 'rentalcar.id', '=', 'ad_rent.id_rentalcar')
        ->join('model', 'rentalcar.id_model', '=', 'model.id')
        ->join('fuel', 'rentalcar.id_fuel', '=', 'fuel.id')
        ->join('drivetrain', 'rentalcar.id_drivetrain', '=', 'drivetrain.id')
        ->join('transmission', 'rentalcar.id_transmission', '=', 'transmission.id')
        ->join('bodytype', 'rentalcar.id_bodytype', '=', 'bodytype.id')
        ->join('make', 'rentalcar.id_make', '=', 'make.id')
        ->join('province', 'rentalcar.id_province', '=', 'province.id')
        ->join('rental_image', 'rentalcar.id', '=', 'rental_image.id_rentalcar')
        // ->join('favorite_rental', 'rentalcar.id', '=', 'favorite_rental.id_frentalcar')
       ->where('rentalcar.trash', 0)
       ->where('ad_rent.status', 1)
       ->whereDate('ad_rent.expiration_date', '>', $now)
       ->where('rental_image.is_main', 1)   
       ; 
       $orderBy = 'ad_rent.id_adtype';
       $orderType = 'desc';
       

       if(!empty($sortByArr) && is_array($sortByArr)){
           if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
               $orderBy = trim($sortByArr['sortBy']);
               $orderType = trim($sortByArr['sortType']);        
           } 
       }

       $rentalcar = $rentalcar->orderBy($orderBy, $orderType);
       

       if(!empty($filters)){
           $rentalcar = $rentalcar->where($filters);
       }

      

       if(!empty($keywords)){
           $rentalcar = $rentalcar->where(function($query) use ($keywords){
               $query->orWhere('car_name', 'like', '%'.$keywords.'%');
               $query->orWhere('location', 'like', '%'.$keywords.'%');
               $query->orWhere('rentalcar.id', 'like', '%'.$keywords.'%');
           });                     
       }

      // $users = $users->get(); 

      //phân trang
       if(!empty($perPage)){
           $rentalcar = $rentalcar->paginate($perPage)->withQueryString();
       
       }else{
        $rentalcar = $rentalcar->get();
       }
       

    //    $sql = DB::getQueryLog();
    //    //dd($lists);
    //    dd($sql);

       return $rentalcar;
    }
    public function getAllRentalcarOfUser($filters = [], $keywords = null, $sortByArr = null, $perPage = null){
        //too raw
     // $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
     //DB::enableQueryLog();
     $now = now();
     $rentalcar = DB::table($this->table)
     ->select('rentalcar.*', 
     'users.fullname as user_name',
     'model.name as model_name',
     'fuel.name as fuel_name',
     'drivetrain.name as drivetrain_name', 
     'transmission.name as transmission_name',
     'bodytype.name as bodytype_name',
     'make.name as make_name',
     'province.name as province_name',
     'rental_image.link as image_link',
    // 'favorite_rental.id_frentalcar as id',
     'ad_rent.status as ad_status',
      'ad_rent.price as adprice',
     'ad_rent.id_adtype as adtype',
     'ad_rent.rentaldays as rentaldays',
     'ad_rent.expiration_date as expdate'
     )
  //  ->join('groups', 'users.group_id', '=', 'groups.id')
      ->join('users', 'rentalcar.id_user', '=', 'users.id')
        ->join('ad_rent', 'rentalcar.id', '=', 'ad_rent.id_rentalcar')
      ->join('model', 'rentalcar.id_model', '=', 'model.id')
      ->join('fuel', 'rentalcar.id_fuel', '=', 'fuel.id')
      ->join('drivetrain', 'rentalcar.id_drivetrain', '=', 'drivetrain.id')
      ->join('transmission', 'rentalcar.id_transmission', '=', 'transmission.id')
      ->join('bodytype', 'rentalcar.id_bodytype', '=', 'bodytype.id')
      ->join('make', 'rentalcar.id_make', '=', 'make.id')
      ->join('province', 'rentalcar.id_province', '=', 'province.id')
      ->join('rental_image', 'rentalcar.id', '=', 'rental_image.id_rentalcar')
    //   ->join('favorite_rental', 'rentalcar.id', '=', 'favorite_rental.id_frentalcar')
     ->where('rentalcar.trash', 0)
    //  ->where('rentalcar.status', 1)
     ->where('rentalcar.id_user', auth()->user()->id)
     
     ->where('rental_image.is_main', 1);
     
     $orderBy = 'rentalcar.created_at';
     $orderType = 'desc';
     

     if(!empty($sortByArr) && is_array($sortByArr)){
         if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
             $orderBy = trim($sortByArr['sortBy']);
             $orderType = trim($sortByArr['sortType']);        
         } 
     }

     $rentalcar = $rentalcar->orderBy($orderBy, $orderType);
     

     if(!empty($filters)){
         $rentalcar = $rentalcar->where($filters);
     }

     if(!empty($keywords)){
         $rentalcar = $rentalcar->where(function($query) use ($keywords){
             $query->orWhere('car_name', 'like', '%'.$keywords.'%');
             $query->orWhere('location', 'like', '%'.$keywords.'%');
             $query->orWhere('rentalcar.id', 'like', '%'.$keywords.'%');
         });
     }

    // $users = $users->get(); 

    //phân trang
     if(!empty($perPage)){
         $rentalcar = $rentalcar->paginate($perPage)->withQueryString();
     }else{
      $rentalcar = $rentalcar->get();
     }
     

  //    $sql = DB::getQueryLog();
  //    //dd($lists);
  //    dd($sql);

     return $rentalcar;
  }

    public function getAllRentalFavo($filters = [], $keywords = null, $sortByArr = null, $perPage = null){
        //too raw
     // $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
     //DB::enableQueryLog();
     $rentalcar = DB::table($this->table)
     ->select('rentalcar.*', 
     'users.fullname as user_name',
     'model.name as model_name',
     'fuel.name as fuel_name',
     'drivetrain.name as drivetrain_name', 
     'transmission.name as transmission_name',
     'bodytype.name as bodytype_name',
     'make.name as make_name',
     'province.name as province_name',
     'rental_image.link as image_link',
    'favorite_rental.id_frentalcar as id',
    'ad_rent.status as ad_status',
    'ad_rent.id_adtype as adtype',
    'ad_rent.price as adprice',
    'ad_rent.expiration_date as expdate'
     )
  //  ->join('groups', 'users.group_id', '=', 'groups.id')
      ->join('users', 'rentalcar.id_user', '=', 'users.id')
      ->join('ad_rent', 'rentalcar.id', '=', 'ad_rent.id_rentalcar')
      ->join('model', 'rentalcar.id_model', '=', 'model.id')
      ->join('fuel', 'rentalcar.id_fuel', '=', 'fuel.id')
      ->join('drivetrain', 'rentalcar.id_drivetrain', '=', 'drivetrain.id')
      ->join('transmission', 'rentalcar.id_transmission', '=', 'transmission.id')
      ->join('bodytype', 'rentalcar.id_bodytype', '=', 'bodytype.id')
      ->join('make', 'rentalcar.id_make', '=', 'make.id')
      ->join('province', 'rentalcar.id_province', '=', 'province.id')
      ->join('rental_image', 'rentalcar.id', '=', 'rental_image.id_rentalcar')
      ->join('favorite_rental', 'rentalcar.id', '=', 'favorite_rental.id_frentalcar')
     ->where('rentalcar.trash', 0)
     ->where('favorite_rental.id_fuser', auth()->user()->id)
     ->where('rental_image.is_main', 1)
     ; 
     $orderBy = 'rentalcar.created_at';
     $orderType = 'desc';
     

     if(!empty($sortByArr) && is_array($sortByArr)){
         if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
             $orderBy = trim($sortByArr['sortBy']);
             $orderType = trim($sortByArr['sortType']);        
         } 
     }

     $rentalcar = $rentalcar->orderBy($orderBy, $orderType);
     

     if(!empty($filters)){
         $rentalcar = $rentalcar->where($filters);
     }

     if(!empty($keywords)){
         $rentalcar = $rentalcar->where(function($query) use ($keywords){
             $query->orWhere('car_name', 'like', '%'.$keywords.'%');
             $query->orWhere('location', 'like', '%'.$keywords.'%');
             $query->orWhere('rentalcar.id', 'like', '%'.$keywords.'%');
         });
     }

    // $users = $users->get(); 

    //phân trang
     if(!empty($perPage)){
         $rentalcar = $rentalcar->paginate($perPage)->withQueryString();
     }else{
      $rentalcar = $rentalcar->get();
     }
     

  //    $sql = DB::getQueryLog();
  //    //dd($lists);
  //    dd($sql);

     return $rentalcar;
  }
    public function rentalImages()
{
    return $this->hasMany(RentalImage::class, 'id_rentalcar', 'id');
}

public function addRental($data){
    // DB::insert('INSERT INTO users (fullname, email, create_at) values (?, ?, ?)', $data);
    return DB::table($this->table)->insert($data);

    // $sql = DB::getQueryLog();
    //    //dd($lists);
    // dd($sql);
 
 }
 public function getDetail($id){
    return DB::select('SELECT * FROM '.$this->table.' WHERE id =?', [$id]);
 }
}
