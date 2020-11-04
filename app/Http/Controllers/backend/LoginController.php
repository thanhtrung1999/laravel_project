<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\models\User;

class LoginController extends Controller
{
    public function getLogin(){
        return view('backend.login.login');
    }

    public function postLogin(LoginRequest $request){
        $check_login = Auth::attempt(['email'=>$request->email, 'password'=>$request->password]);
//        $query_builder = User::where('email', $request->email)->where('password', $request->password)->count();
        if($check_login){
//            $email = $request->email;
//            session()->put('email', $email);
            session()->flash('success', 'Đăng nhập thành công');
            return redirect('admin');
        } else {
            session()->flash('error', 'Sai email hoặc password');
            return redirect('login')->withInput();
        }
    }

    public function getIndex(){
        return view('backend.index');
    }

    public function logout(){
        Auth::logout();
        session()->flash('success', 'Đăng xuất thành công');
        return redirect('login');
    }
}
