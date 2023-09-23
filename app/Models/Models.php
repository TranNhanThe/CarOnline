<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Models extends Model
{
    use HasFactory;

    protected $table = 'model';

    public function getAll(){
        $model = DB::table($this->table)
        ->orderBy('name', 'ASC')
        ->get();

        return $model;
    }
}
