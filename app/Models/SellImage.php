<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SellImage extends Model
{
    use HasFactory;
    protected $table = 'sell_image';

    public function getAllImage(){
        $sell_image = DB::table($this->table)
        ->select('sell_image.*', 'sellcar.car_name as sellcar_name')
        ->join('sellcar', 'sell_image.id_sellcar', '=', 'sellcar.id'); 
        $orderBy = 'created_at';
        $orderType = 'desc';

            $sell_image = $sell_image->get();

        return $sell_image;
    }
    public function sellcar()
    {
        return $this->belongsTo(SellCar::class, 'id_sellcar');
    }
}
