<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function config(){
        return view('user.config');
    }
    
    public function update(Request $request){
        // Recojo los datos del usuario
        $id=\Auth::user()->id;
        $name = $request->input('name');
        $surname=$request->input('surname');
        $nick= $request->input('nick');
        $email=$request->input('email');
        
    }
}
