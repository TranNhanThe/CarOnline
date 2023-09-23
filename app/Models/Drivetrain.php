<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Drivetrain extends Model
{
    use HasFactory;

    protected $table = 'drivetrain';

    public function getAll(){
        $drivetrain = DB::table($this->table)
        ->orderBy('name', 'ASC')
        ->get();

        return $drivetrain;
    }
}
