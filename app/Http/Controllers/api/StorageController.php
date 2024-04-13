<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function storage(Request $request){
        $extImg = $request->file('imagen')->extension();
        $aletImg = rand(1, 100000);
        $img = $aletImg . '.' . $extImg;
        $request->file('imagen')->storeAs('public/img/perfil/', $img);
        return "storage";
    }
}
