<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function config(){
        return view('user.config');
    }
    
    public function update(Request $request){
        // Recojo el id del usuario logado 
        $user=\Auth::user();
        
        $id=$user->id;
        

        //  Validación de datos 
               
        // La validación de nick y email la parte de unique:users,email,'.$id
        // Significa que el nick sea único en la tabla de usuarios excepto que el nick coincida 
        // con el nick del id del usuario logado, la misma validación se la ponems al email
        $validate = $this->validate($request,[
            'name'=>'required|alpha|max:255',
            'surname'=>'required|alpha|max:255',
            'nick'=>'required|string|max:255|unique:users,nick,'.$id, 
            'email'=>'required|string|email|max:255|unique:users,email,'.$id
        ]);
        
        // Recojo los datos del usuario
        
        $name = $request->input('name');
        $surname=$request->input('surname');
        $nick= $request->input('nick');
        $email=$request->input('email');
        
        // Asignar nuevos valores al objeto del usuario 
        $user->name=$name;
        $user->surname=$surname;
        $user->nick=$nick;
        $user->email=$email;
        
        // Guardamos la imagen del usuario para ello :
        // 1ª) Recogemos el archivo de imagen que llega por el formulario en image_path
        $image_path=$request->file('image');
        if($image_path){
            // Guardamos el nombre que tendrá el fichero de la imagen que suba el usuario al 
            //servidor
            $image_path_name=time().$image_path->getClientOriginalName();
            
            
            //Guardamos fisicamente el archivo que el usuario ha elegido en el storage
            //(storage/app/users)
            Storage::disk('users')->put($image_path_name,File::get($image_path));
            
            // Por ultimo seteamos la propiedad image del objeto user para que al hacer abajo el 
            //método update() se guarde correctamente en la base de datos
            $user->image=$image_path_name;
        }
        
        
        // Ejecutar consulta y cambios en la base de datos 
        $user->update();
        
        return redirect()->route('config')->with(['message'=>'Usuario actualizado correctamente']);
    }
}
