<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Propiedad para indicarle la tabla que esta relacionada con este modelo
    protected $table = 'images';
    
    //  Relación de image con tabla comments , Relación One To Many / De uno a muchos 
    public function comments(){ // Este método saca todos lo comentarios que tiene una imagen 
        return $this->hasMany('App\Comment');
    }
    
    // Relación de image con tabla likes, Relación One To Many / De uno a muchos 
    public function likes(){ // Este método saca todos los likes que tiene una imagen 
        return $this->hasMany('App\Like');
    }
    
    // Relación de muchos a Uno
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    
    
}
