<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ByUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

use Attribute;

class UsersController extends Controller
{
    private $users;

    private $rental_image;


    const _PER_PAGE = 4;
    public function __construct(){
        $this->users = new Users();
    }
    public function index(Request $request){
       //$statement = $this->users->statementUser("DELETE FROM users");
        
        $title = 'Danh sách người dùng';

       // $this->users->learnQueryBuilder();
        $filters = [];
        $keywords = null;
        if (!empty($request->status)){
            $status = $request->status; 
            if ($status == 'active'){
                $status = 1;
            }else{
                $status = 0;
            }

            $filters[] =  ['users.status', '=', $status];

     
        }
        if (!empty($request->group_id)){
            $groupId = $request->group_id; 
            $filters[] =  ['users.group_id', '=', $groupId];
        }

        if (!empty($request->keywords)){
            $keywords = $request->keywords;
             
        }

        //Xử lý logic sắp xếp

        $sortBy = $request->input('sort-by');
        
        $sortType = $request->input('sort-type')?$request->input('sort-type'):'asc'; 

        $allowSort = ['asc', 'desc'];

        if(!empty($sortType)&&in_array($sortType, $allowSort, $sortBy)){
            if($sortType == 'desc'){
                        $sortType = 'asc';
            }else{
                        $sortType = 'desc';
             } 
        }else{
            $sortType = 'asc';
        }

        
        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];

        $usersList = $this->users->getAllUsers($filters, $keywords, $sortArr, self::_PER_PAGE); 
        return view('clients.users.lists', compact('title', 'usersList', 'sortType'));
    }
    public $data = [];
public function userinfo()
{
    $this->data['title'] = 'Thông tin cá nhân';
    return view('clients.users.info', $this->data);
}

public function postUserInfo(ByUserRequest $request){
    // dd($request->all());
    $id = auth()->user()->id;
    if ($request->hasFile('cccd_image')) {
        $cccd_image = $request->file('cccd_image');
        $imagecccd = $cccd_image->store('user_image', 'public');
        $dataUpdate['cccd_image'] = $imagecccd; 
    }
    if ($request->hasFile('licence_image')) {
        $imageblx = $request->licence_image->store('user_image', 'public');
        $dataUpdate['licence_image'] = $imageblx;
    }
    if ($request->has('bank_name')) {
        $dataUpdate['bank_name'] = $request->bank_name;
    }
    if ($request->has('stk')) {
        $dataUpdate['stk'] = $request->stk;
    }
    
    $this->users->updateUser($dataUpdate, $id);
    return  redirect()->route('users.userinfo')->with('msg', 'Update thông tin thành công');
    
}

    public function add(){
        $title = 'Thêm người dùng';

        $allGroups = getAllGroups(); 
        return view('clients.users.add', compact('title', 'allGroups'));
    }

    public function postAdd(UserRequest $request){
        


        // $dataInsert = [
        //     $request->fullname,
        //     $request->email,
        //     date('Y-m-d H:i:s')
        // ];
            $pictureInsert = [
                'souta' => $request->souya,
                'rage' => $request->gas,
            ];

            $dataInsert = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'group_id' => $request->group_id,
                'status' => $request->status,
                'create_at' => date('Y-m-d H:i:s' )
            ];

        $this->users->addUser($dataInsert);
        $this->rental_image->addImage($pictureInsert);

        return redirect()->route('users.index')->with('msg', 'Thêm người dùng thành công');
    }
    

    public function getEdit(Request $request, $id=0){
        
            $title = 'Cập nhật người dùng';

            if (!empty($id)){
                $userDetail = $this->users->getDetail($id);
                if(!empty($userDetail[0])){
                    $request->session()->put('id', $id);
                    $userDetail = $userDetail[0];
                }else{
                    return redirect()->route('users.index')->with('msg', 'Nguời dùng không tồn tại');
                }
            }else{
                return redirect()->route('users.index')->with('msg', 'Liên kết không tồn tại');
            }
$allGroups = getAllGroups();
            return view('clients.users.edit', compact('title', 'userDetail', 'allGroups'));
        
             
    }

    public function postEdit(UserRequest $request, $id=0){
        $id = session('id');
        if (empty($id)){
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $dataUpdate =[
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'update_at' => date('Y-m-d H:i:s' )
        ];
        $this->users->updateUser($dataUpdate, $id);

        return back()->with('msg','Cập nhật người dùng thành công');
    }

    public function delete($id=0){
        if (!empty($id)){
            $userDetail = $this->users->getDetail($id);
            if(!empty($userDetail[0])){
               $deleteStatus = $this->users->deleteUSer($id);
               if($deleteStatus){
                    $msg = 'Xóa người dùng thành công';
               }else{
                    $msg = 'Bạn không thể xóa người dùng lúc này. Vui lòng thử lại sau';
               }
            }else{
                $msg = 'Người dùng không tồn tại';
            }
        }else{
            $msg = 'Liên kết không tồn tại ';
        }

        return redirect()->route('users.index')->with('msg', $msg);
    }

    
}
