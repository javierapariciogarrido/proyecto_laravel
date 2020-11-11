<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //Propiedad para relacionar el modelo con la tabla a la que estará vinculada esta clase 
    protected $table = 'likes';
    
    
    // Relación con la tabla images  - relación de muchos a uno 
    public function image(){
        return $this->belongsTo('App\Image','image_id');
    }
    
    // Relación con la tabla de usuarios - Relación de muchos a uno 
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
