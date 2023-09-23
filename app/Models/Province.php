<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Province extends Model
{
    use HasFactory;

    protected $table = 'province';

    public function getAll(){
        $province = DB::table($this->table)
        ->orderBy('name', 'ASC')
        ->get();

        return $province;
    }
}
