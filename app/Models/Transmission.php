<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transmission extends Model
{
    use HasFactory;

    protected $table = 'transmission';

    public function getAll(){
        $transmission = DB::table($this->table)
        ->orderBy('name', 'ASC')
        ->get();

        return $transmission;
    }
}
