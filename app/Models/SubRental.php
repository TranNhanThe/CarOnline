<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SubRental extends Model
{
    use HasFactory;
    protected $table = 'sub_rental';

    public function getAll(){
        $sub_rental = DB::table($this->table)
        ->orderBy('name', 'ASC')
        ->get();

        return $sub_rental;
    }
}
