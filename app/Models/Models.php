<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Models extends Model
{
    use HasFactory;

    protected $table = 'model';

    public function getAllModel($filtersi = [], $keywordsi = null, $sortByArri = null, $perPage = null){
        $model = DB::table($this->table)
        ->select('model.*','make.name as make_name')  
         ->join('make', 'model.id_make', '=', 'make.id');
         $orderByi = 'model.name';
         $orderTypei = 'asc';

         if(!empty($sortByArr) && is_array($sortByArr)){
            if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
                $orderByi = trim($sortByArr['sortBy']);
                $orderTypei = trim($sortByArr['sortType']);        
            } 
        }
        $model = $model->orderBy($orderByi, $orderTypei);

        if(!empty($filtersi)){
            $model = $model->where($filtersi);
        }

        if(!empty($keywordsi)){
            $model = $model->where(function($query) use ($keywordsi){
                $query->orWhere('model.name', 'like', '%'.$keywordsi.'%');
            });
        }
        if(!empty($perPage)){
            $model = $model->paginate($perPage)->withQueryString();
        }else{
            $model = $model->get();
        }

        return $model;
    }
    public function addModel($data){
        // DB::insert('INSERT INTO users (fullname, email, create_at) values (?, ?, ?)', $data);
        return DB::table($this->table)->insert($data);
     }
}
