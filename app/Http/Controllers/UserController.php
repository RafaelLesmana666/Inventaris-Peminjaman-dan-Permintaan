<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $user = User::orderBy('created_at','asc')->simplePaginate(5);
        return view('admin.daftarUser',['user' => $user]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return back();
    }
}
