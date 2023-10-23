<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Utilities extends Model
{
    use HasFactory;
    protected $table = 'utilities';
    public function getAllUtilities(){
        $utilities = DB::table($this->table)
        ->select('utilities.*', 'rentalcar.car_name as rentalcar_name')
        ->join('rentalcar', 'utilities.id_rentalcar', '=', 'rentalcar.id'); 
        $orderBy = 'create_at';
        $orderType = 'desc';

            $utilities = $utilities->get();

        return $utilities;
    }
    public function rentalcar()
    {
        return $this->belongsTo(RentalCar::class, 'id_rentalcar');
    }
}
