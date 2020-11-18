<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // MEDIANTE ELOQUENT HAGO ORDER BY DESC Y LUEGO OBTENGO CON GET TODAS LAS IMAGENES,PERO 
        //PARA PAGINAR EN LUGAR DE HACER METODO GET HAGO METODO PAGINATE Y LE PASO 5 IMAGENES
        $images = Image::orderBy('id','desc')->paginate(5);
        $comentarios=count($images->comments);
        return view('home',[
            'images'=>$images,
            'comentarios'=>$comentarios
        ]);
    }
}
