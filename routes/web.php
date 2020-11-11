<?php

use Illuminate\Support\Facades\Route;
use App\Image;
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

Route::get('/', function () {
    $images = Image::all(); // Metodo del orm que saca todas las imagenes en un array
    foreach($images as $image){
        echo $image->image_path.'<br>';
        echo $image->description.'<br>';
        echo $image->user->name;
        echo $image->user->surname;
        echo "<hr>";
    }
    die();
    
    return view('welcome');
});
