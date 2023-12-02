<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Sell_utilities extends Model
{
    use HasFactory;
    protected $table = 'sell_utilities';
    public function getAllSellUtilities(){
        $sell_utilities = DB::table($this->table)
        ->select('sell_utilities.*', 'sellcar.car_name as sellcar_name')
        ->join('sellcar', 'sell_utilities.id_sellcar', '=', 'sellcar.id'); 
        $orderBy = 'create_at';
        $orderType = 'desc';

            $sell_utilities = $sell_utilities->get();

        return $sell_utilities;
    }
    public function sellcar()
    {
        return $this->belongsTo(SellCar::class, 'id_sellcar');
    }
}
