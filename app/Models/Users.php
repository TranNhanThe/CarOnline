<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';
    

    public function getAllUsers($filters = [], $keywords = null, $sortByArr = null, $perPage = null){
        //too raw
       // $users = DB::select('SELECT * FROM users ORDER BY create_at DESC');
       //DB::enableQueryLog();
        $users = DB::table($this->table)
        ->select('users.*', 'groups.name as group_name')
        ->join('groups', 'users.group_id', '=', 'groups.id')
        ->where('trash', 0); 
        $orderBy = 'users.created_at';
        $orderType = 'desc';

        if(!empty($sortByArr) && is_array($sortByArr)){
            if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);        
            } 
        }

        $users = $users->orderBy($orderBy, $orderType);
        

        if(!empty($filters)){
            $users = $users->where($filters);
        }

        if(!empty($keywords)){
            $users = $users->where(function($query) use ($keywords){
                $query->orWhere('fullname', 'like', '%'.$keywords.'%');
                $query->orWhere('email', 'like', '%'.$keywords.'%');
            });
        }

       // $users = $users->get(); 

       //phân trang
        if(!empty($perPage)){
            $users = $users->paginate($perPage)->withQueryString();
        }else{
            $users = $users->get();
        }
        

        //$sql = DB::getQueryLog();
        //dd($lists);
        //dd($sql);

        return $users;
    }

    public function addUser($data){
       // DB::insert('INSERT INTO users (fullname, email, create_at) values (?, ?, ?)', $data);
       return DB::table($this->table)->insert($data);
    }

    public function addImage($data){
        DB::insert('INSERT INTO rental_image (link, id_rental, create_at) values (?, ?, ?)', $data);
    }

    public function getDetail($id){
       return DB::select('SELECT * FROM '.$this->table.' WHERE id =?', [$id]);
    }

    public function updateUser($data, $id){

        // $data[] = $id;

        // return DB::update('UPDATE '.$this->table.' SET fullname=?, email=?, update_at=? where id = ?', $data);

        return DB::table($this->table)->where('id', $id)->update($data);

    }

    public function deleteUser($id){
       //return DB::delete("DELETE FROM $this->table WHERE id=?", [$id]);
       return DB::table($this->table)->where('id', $id)->delete();
    }

    public function statementUser($sql){
        return DB::statement($sql);
    }

    public function learnQueryBuilder(){
        DB::enableQueryLog();
       
        // //lấy tất cả bản ghi của table
        // $id=20-8;
        // $lists = DB::table($this->table)
        // ->select('fullname as hoten', 'email', 'id', 'update_at', 'create_at' )
        // //->where('id', 5)
        // //->where('id', '<>', 5)
        // // ->where('id', '>=',5)
        // // ->where('id', '<=',6)
        // // ->where([
        // //     [
        // //         'id', '>=', 5
        // //     ], 
        // //     [
        // //         'id', '<=', 6
        // //     ]
        // // ])
        // // ->where('id', 5)
        // // ->where('id', 7)
   
        // // ->where(function($query) use ($id){
        // //    // $query->where('id', '<', 7)->orWhere('id', '>', 9);
        // //     //$query->orWhere('id', '>', 9);
        // //     $query->where('id', '<', $id)->orWhere('id', '>', $id);
        // //})

        // // ->orWhere('id', 6)
        // //->where('fullname', 'like', '%kila%')
        // //->whereBetween('id', [7, 10])
        // //->whereYear('create_at', '2022')
        // //->whereColumn('create_at','<', 'update_at')
        // ->get();
        //->toSql();
       //dd($lists);

            //join bảng
        //$lists = DB::table('users')
       //->select('users.*', 'groups.name as group_name')
        //->rightJoin('groups', 'users.group_id', '=', 'groups.id')
        //->orderBy('create_at', 'asc')
        //->orderBy('id', 'desc')
        //->inRandomOrder()
        // ->select(DB::raw('count(id) as email_count'), 'email', 'fullname')
        // ->groupBy('email')
        // ->groupBy('fullname')
        //->having('email_count', '>=', 2)
        // ->limit(2)
        // ->offset(5)
        //->take(3)
        //->skip (2)
        //->get();
        // $status = DB::table('users')->insert([
        //     'fullname' => 'Nguyễn Văn A',
        //     'email' => 'nguyenvanan@gmail.com',
        //     'group_id' => 1,
        //     'create_at' => date('Y-m-d H:i:s')
        // ]);
        //dd($status);

        //$lastId = DB::getPdo()->lastInsertId();

        // $lastId = DB::table('users')->insertGetId([
        //     'fullname' => 'Nguyễn Văn A',
        //     'email' => 'nguyenvana@gmail.com',
        //     'group_id' => 1,
        //     'create_at' => date('Y-m-d H:i:s')
        // ]);
        // $status = DB::table('users')
        // ->where('id', 10)
        // ->update([
        //     'fullname' => 'Nguyễn Văn B',
        //     'email' => 'nguyenvanb@gmail.com',
        //     'update_at' => date('Y-m-d H:i:s')
        // ]);
        
        // $status = DB::table('users')
        // ->where('id', 10)
        // ->delete();
    
        // $lists = DB::table('users')->where('id', '>',  6)->get();
        // $count = count($lists);
        //dd($count);
        //dd($status);

        //dd($lastId);

        $lists = DB::table('users')
        // ->select(
        //     DB::raw('`fullname` as hoten, `email` ')
        // )
        //->selectRaw('email, count(id) as email_count, fullname')
        //->where(DB::raw('id>20'))
        //->where('id', '>', 8)
       // ->groupBy('email')
        // ->groupBy('fullname')
        //->orwhereRaw('id > 8')
        //->orderByRaw('create_at DESC, update_at ASC')
        //->orderBy(DB::raw('create_at DESC'), '')
        //->groupByRaw('email, fullname')
        //->having('email_count', '>=', 8)
        //->havingRaw('email_count > ?', [2])
        // ->where(
        //     'group_id', 
        // '=', 
        // function($query){
        //     $query->select('id')
        //     ->from('groups')
        //     ->where('name', '=', 'Administrator');
        // }
        // )
        //->select('email', DB::raw('(SELECT count(id) FROM `groups`) as group_count')) 
        ->selectRaw('email, (SELECT count(id) FROM `groups`) as group_count')
        
        ->get();
       dd($lists);

        

        //lấy 1 bản ghi đầu tiên của table(Lấy thông tin chi tiết)
        $detail = DB::table($this -> table)->first();
        dd($detail->email);
    }
}
