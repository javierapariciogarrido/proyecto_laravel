<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Storage; // Para almacenar en el storage el archivo
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response; // Para hacer respuesta correctamente en el metodo de sacar imagen

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
        
                
        // Subir Fichero
        if($image_path){
            // Creo un nuevo nombre de fichero con código timestamp delante seguido del nombre 
            //original del fichero subido este nombre sera el nombre con el que se suba al servidor
            $image_path_name= time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name,File::get($image_path));
            
            //Seteo valores al objeto image 
            
            $image = new Image();
        
            $image->description=$descripcion;
            $image->user_id=$user_id;
            // Seteo el campo  del nombre del fichero guardado en el objeto de image 
            $image->image_path=$image_path_name;
        }
        
        // Guardamos el objeto image ya que tiene todos los campos rellenos
        $image->save();
        return redirect()->route('home')->with(['message'=>'La foto ha sido subida correctamente']);
    }
    
    public function getImage($filename){
        // Saco el fichero de imagen que le paso por parametro al método y que está almacenada en
        //  la carpeta storage/app/images y meto el fichero en la variable file
        $file = Storage::disk('images')->get($filename);
        
    return new Response($file,200);       
    }
    
    
    
    
}
