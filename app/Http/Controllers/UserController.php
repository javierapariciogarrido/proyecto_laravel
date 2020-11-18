<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;   

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
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
        $reglas=['name'=>'required|alpha|max:255',
            'surname'=>'required|alpha|max:255',
            'nick'=>'required|string|max:255|unique:users,nick,'.$id, 
            'email'=>'required|string|email|max:255|unique:users,email,'.$id];
        
        /*
        $validate = $this->validate($request,[
            'name'=>'required|alpha|max:255',
            'surname'=>'required|alpha|max:255',
            'nick'=>'required|string|max:255|unique:users,nick,'.$id, 
            'email'=>'required|string|email|max:255|unique:users,email,'.$id
        ]);
        */
        // Personalización de mensajes de error en la validación
        $messages=[
            'name.required'=>'¡¡DEBES DE INTRODUCIR UN NOMBRE DE USUARIO!!',
            'name.alpha'=>'¡¡EL NOMBRE SE COMPONE SOLO DE LETRAS!!',
            'name.max'=>'¡¡EL NOMBRE DE USUARIO NO PUEDE SER MAYOR A :max CARACTERES!!',
            'surname.required'=>'¡¡DEBES DE INTRODUCIR APELLIDOS!!',
            'surname.alpha'=>'¡¡LOS APELLIDOS SE COMPONEN SOLO DE LETRAS!!',
            'surname.max'=>'¡¡LOS APELLIDOS NO PUEDEN SER MAYOR A :max CARACTERES!!',
            'nick.required'=>'¡¡DEBES INTRODUCIR UN NICK!!',
            'nick.string'=>'¡¡EL NICK DEBE SER SÓLO TEXTO',
            'nick.max'=>'¡¡EL NICK DEL USUARIO NO PUEDE SER MAYOR A :max CARACTERES!!',
            'nick.unique'=>'¡¡EL NICK INTRODUCIDO YA EXISTE!!',
            'email.required'=>'¡¡DEBES INTRODUCRI UN EMAIL DE USUARIO!!',
            'email.string'=>'¡¡EL EMAIL DEBE SER SÓLO TEXTO',
            'email.email'=>'¡¡EL EMAIL INTRODUCIDO YA EXISTE!!',
            'email.max'=>'¡¡EL EMAIL NO PUEDE SER MAYOR A :max CARACTERES!!',
            'email.unique'=>'¡¡EL EMAIL INTRODUCIDO YA EXISTE!!'
        ];
        // Validación 
        $this->validate($request,$reglas,$messages);
        
        
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
        
        /*AQUI HAY QUE IMPLEMENTAR QUE ANTES DE GUARDAR LA IMAGEN SI EL USUARIO YA TIENE UNA 
        IMAGEN GUARDADA HAY QUE BORRAR DEL SERVIDOR LA IMAGEN QUE TIENE ACTUALMENTE PARA ASI NO 
         * SATURAR EL SERVIDOR DE IMAGENES UN MISMO CLIENTE
        Preguntariamos if ($user->image) entonces borramos en el disco la imagen 
         */
                
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
    
    public function getImage($filename){
        // Saco el fichero de imagen que le paso por parametro al método y que está almacenada en
        //  la carpeta storage/app/users y meto el fichero en la variable file
        $file=Storage::disk('users')->get($filename);
    return new Response($file,200);       
    }
    
    
    
    
}
