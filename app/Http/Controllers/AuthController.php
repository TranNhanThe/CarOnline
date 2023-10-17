<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class AuthController extends Controller
{
    public $data = [];

    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'cccd',
        'password',
        'avatar' // Đảm bảo trường 'avatar' được thêm vào đây
    ];
    
    public function register(){
        $this->data['title'] = 'Đăng Ký';
        return view('Auth.register', $this->data);
    }

    public function registerPost(UserRequest $request)
    {
        

        $users = new Users();
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('avatars', 'public'); // Lưu hình ảnh vào thư mục 'avatars'
            // $avatarPath = $request->file('avatar')->store('avatars', 'public');
           
            $users->avatar = $avatarPath;
        }

        $users->fullname = $request->fullname;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->cccd = $request->cccd;
        $users->credit = 200;
        $users->password = Hash::make($request->password);
        
        
        
        
        $users->save();
        return back()->with('success', 'Register successfully');
    }
 
    public function login()
    {
        $this->data['title'] = 'Đăng Nhập';
        return view('Auth.login', $this->data);
    }
 
    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credetials)) {
            return redirect('/rental')->with('success', 'Login Success');
        }
 
        return back()->with('error', 'Error Email or Password');
    }
 
    public function logout()
    {
        Auth::logout();
 
        return redirect()->route('login');
    }

}
