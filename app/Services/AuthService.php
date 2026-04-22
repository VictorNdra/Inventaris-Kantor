<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthService{

public function showLogin(){
    return view('auth.login');
}
 
public function register(array $data){
    $data['password'] = Hash::make($data['password']);
    return User::Create($data);
}

public function login(Request $request){
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if(Auth::attempt($credentials)){
        $request->session()->regenerate();
        $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('admin/dashboard');
            }
            return redirect()->intended('pegawai/dashboard');
        }
        return back()->with('Error','Email/Password Incorrect');

}
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function registerProses(Request $request){
          $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8' 
        ]);

        $data['role'] = 'user';

       DB::transaction(function () use ($data) {
           User::create($data);
       }); 

        return redirect()->route('login')->with('Success','Register Successful');


    }
}