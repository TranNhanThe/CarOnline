<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Make extends Model
{
    use HasFactory;

    protected $table = 'make';

    public function getAll(){
        $make = DB::table($this->table)
        ->orderBy('name', 'ASC')
        ->get();

        return $make;
    }
}
