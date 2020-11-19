<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;


class CommentController extends Controller
{
    
    //MIDDLEWARE DE AUTENTICACIÓN,PARA HACER QUE A LAS RUTAS DE COMENTARIOS SOLO SE ACCEDA LOGADOS
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function save(Request $request){
        
        //Validacion consta de: 
        
        //1) Definir array con las reglas
        $rules=[
            'image_id'=>'integer|required',
            'content'=>'required'
        ];
        
        //2) Definir el mensaje de error que dara cuando no cumpla la regla de validación definida
        $comments=[
            'content.required'=>'¡¡TIENES QUE INTRODUCIR ALGÚN COMENTARIO!!',
            'image_id.integer'=>'¡¡EL ID DE LA IMAGEN HA DE SER UN NUMERO!!',
            'image_id.required'=>'¡¡EL ID DE LA IMAGEN ES OBLIGATORIO!!'    
        ];
        
        //3) POR ULTIMO SE USA EL MÉTODO VALIDATE QUE TRAE EL CONTROLADOR DE LARAVEL
        $this->validate($request,$rules,$comments);
        
        
        // Rellenamos el objeto comment
        $user_id = $request->input('user_id');
        $image_id = $request->input('image_id');
        $content= $request->input('content');
        
        //Creamos el objeto comment (Instancia)
        $comment = new Comment();
        
        // Asiganos contenido al objeto comment y Guardamos el objeto del comentario
        $comment->user_id=$user_id;
        $comment->image_id=$image_id;
        $comment->content=$content;
        
     
        $comment->save();
    // Redirección al detalle de la imagen    
    return redirect()->route('image.detail',['id'=>$image_id])->with(['message'=>'¡¡Comentario creado correctamente!!']);    
    }
    
    
}
