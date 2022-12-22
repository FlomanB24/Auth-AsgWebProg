<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        
        if(Auth::attempt($credentials) == true){            
            return redirect()->route('general');
        }else{
            return redirect()->route('admin');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login-page');
    }
}
