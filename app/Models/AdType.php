<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class AdType extends Model
{
    use HasFactory;
    protected $table = 'adtype';

    public function getAll(){
        $adtype = DB::table($this->table)
        ->orderBy('id', 'ASC')
        ->get();

        return $adtype;
    }
}
