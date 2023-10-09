<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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

    public function getA(){
        // $make = DB::table($this->table)
        
        $make = DB::table('make')->Where('id_make')->get()
        ->orderBy('name', 'ASC')
        ->get();

        return $make;
    }
}
