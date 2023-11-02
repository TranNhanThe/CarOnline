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

    public function getAllMake($filters = [], $keywords = null, $sortByArr = null, $perPage = null){
       
        $make = DB::table($this->table)
        ->select('make.*');
        // ->join('groups', 'users.group_id', '=', 'groups.id')
        
        $orderBy = 'make.name';
        $orderType = 'asc';

        if(!empty($sortByArr) && is_array($sortByArr)){
            if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);        
            } 
        }
        $make = $make->orderBy($orderBy, $orderType);

        if(!empty($filters)){
            $make = $make->where($filters);
        }

        if(!empty($keywords)){
            $make = $make->where(function($query) use ($keywords){
                $query->orWhere('name', 'like', '%'.$keywords.'%');
            });
        }

        if(!empty($perPage)){
            $make = $make->paginate($perPage)->withQueryString();
        }else{
            $make = $make->get();
        }
      

        return $make;
    }

    public function getA(){
        // $make = DB::table($this->table)
        
        $make = DB::table('make')->Where('id_make')->get()
        ->orderBy('name', 'ASC')
        ->get();

        return $make;
    }
    public function addMake($data){
        // DB::insert('INSERT INTO users (fullname, email, create_at) values (?, ?, ?)', $data);
        return DB::table($this->table)->insert($data);
     }
}
