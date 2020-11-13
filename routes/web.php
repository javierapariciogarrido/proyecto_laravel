<?php

use Illuminate\Support\Facades\Route;
//use App\Image;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    
    $images = Image::all(); // Metodo del orm que saca todas las imagenes en un array
    foreach($images as $image){
        echo $image->image_path.'<br>';
        echo $image->description.'<br>';
        echo $image->user->name.'  '.$image->user->surname.'<br>' ;
        if(count($image->comments)!=0){
            echo "<h4>Comentarios: </h4>";
            foreach($image->comments as $comment){
                echo $comment->content." Comentario hecho por: ".$comment->user->name.'<br>';
            }
        }    
        
        echo "LIKES : ".count($image->likes)."<br>";
        echo "Han dado likes la siguientes personas: ".'<br>';
        foreach($image->likes as $like){
            echo $like->user->name.'<br>';
        }
        
        echo "<hr>";
            
    }
    die();
    
    return view('welcome');
});
 
 */

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
