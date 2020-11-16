<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    
    // Middleware de autenticación que no deja entrar a no ser que estemos logados 
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function create(){
        return view('image.create');
    } 
    
    public function save(Request $request ){
        // Validacion de datos
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);
        
        
        
        // Recogiendo los datos 
        $user_id = $request->input('user_id');
        $descripcion=$request->input('description');
        $image_path=$request->file('image_path');
        
        // Asignar valores al objeto
        $image = new Image();
        $image->image_path=null;
        $image->description=$descripcion;
        $image->user_id=$user_id;
        
        // Subir Fichero
        
    }
}
