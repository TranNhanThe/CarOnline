<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bodytype extends Model
{
    use HasFactory;

    protected $table = 'bodytype';

    public function getAll(){
        $bodytype = DB::table($this->table)
        ->orderBy('name', 'ASC')
        ->get();

        return $bodytype;
    }
}
