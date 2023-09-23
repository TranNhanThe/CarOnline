<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RentalImage extends Model
{
    use HasFactory;

    protected $table = 'rental_image';

    public function getAllImage(){
        $rental_image = DB::table($this->table)
        ->select('rental_image.*', 'rentalcar.car_name as rentalcar_name')
        ->join('rentalcar', 'rental_image.id_rentalcar', '=', 'rentalcar.id'); 
        $orderBy = 'create_at';
        $orderType = 'desc';

            $rental_image = $rental_image->get();

        return $rental_image;
    }
    public function rentalcar()
    {
        return $this->belongsTo(RentalCar::class, 'id_rentalcar');
    }

}
