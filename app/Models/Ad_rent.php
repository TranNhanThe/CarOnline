<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Ad_rent extends Model
{
    use HasFactory;

    protected $table = 'ad_rent';

    // public function getAll(){
    //     $ad_rent = DB::table($this->table)
    //     ->orderBy('name', 'ASC')
    //     ->get();

    //     return $ad_rent;
    // }
    public function getAllAd_rent(){
        $ad_rent = DB::table($this->table)
        ->select('ad_rent.*', 'rentalcar.car_name as rentalcar_name')
        ->join('rentalcar', 'ad_rent.id_rentalcar', '=', 'rentalcar.id'); 
        $orderBy = 'create_at';
        $orderType = 'desc';

            $ad_rent = $ad_rent->get();

        return $ad_rent;
    }
    public function rentalcar()
    {
        return $this->belongsTo(RentalCar::class, 'id_rentalcar');
    }
}
