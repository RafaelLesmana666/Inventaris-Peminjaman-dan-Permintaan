<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function authanticate(Request $request){
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role'
        ]);

        if(Auth::attempt($data)){
            $request->session()->regenerate();

            if(Auth::user()->role == 'admin'){
                return redirect('/admin');
            }else {
                return redirect('/teknisi');
            }
        }

        return back()->with('error','Username atau Password salah !');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
