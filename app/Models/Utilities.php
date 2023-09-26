<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Utilities extends Model
{
    use HasFactory;
    protected $table = 'utilities';
    public function getAll(){
        $utilities = DB::table($this->table)
        ->orderBy('name', 'ASC')
        ->get();

        return $utilities;
    }
}
