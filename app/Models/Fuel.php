<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fuel extends Model
{
    use HasFactory;

    protected $table = 'fuel';

    public function getAll(){
        $fuel = DB::table($this->table)
        ->orderBy('name', 'ASC')
        ->get();

        return $fuel;
    }
}
