<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermintaanController extends Controller
{
    public function index(){
        $permintaan = Permintaan::orderBy('id','asc')->simplePaginate(5);
        return view('admin.history.permintaan',['permintaan' => $permintaan]);
    }
}
