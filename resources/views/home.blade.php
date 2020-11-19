@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.mensaje') <!-- AQUI SE MUESTRA EL MENSAJE FLASH -->
            <!-- AQUI RECORREMOS LA VARIABLE IMAGES QUE NOS VIENE DEL CONTROLADOR HOME -->
            @foreach($images as $image)
            
            <div class="card imagen_publicada">
                <div class="card-header">

                    @if($image->user->image) <!--SI EL USUARIO TIENE IMAGEN LA MUESTRA-->
                    <div class='container-avatar'>
                        <img src="{{route('user.avatar',['filename'=>$image->user->image])}}" class="avatar">
                    </div>
                    @else <!-- SI EL USUARIO NO TIENE IMAGEN PROPIA MUESTRA UNA SILUETA DESCONOCIDA-->
                    <div class="container-avatar">
                        <img src="{{asset('images/avatar.jpg')}}">    
                    </div>
                    @endif
                    
                    <div class="data-user">
                        <a href="{{route('image.detail',['id'=>$image->id])}}">
                            {{$image->user->name.''.$image->user->surname}}
                            <span class="nickname">
                                {{' | @'.$image->user->nick}}
                            </span>
                        </a>    
                    </div>
                </div>
                <div class="card-body">
                    <!--AQUI MOSTRAMOS LA IMAGEN QUE SUBE EL USUARIO-->
                    <div class="image-container">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}">
                    </div>
                    
                    <div class="description">
                        
                        <span class="nickname">
                            {{'Imagen subida por @'.$image->user->nick}}
                        </span>
                        <span class="nickname">{{'|'.FormatTime::LongTimeFilter($image->created_at)}}</span>
                        
                        <p>{{$image->description}}</p>
                    </div>
                    <div class="container-comentarios-likes">
                        <a href="" class="btn btn-sm btn-warning btn-comments">
                            Comentarios({{count($image->comments)}})
                        </a>
                        <div class="likes">
                            <img  src="{{asset('images/corazon_gris.png')}}">
                        </div>
                    </div>     
                </div>
            </div> <!-- FIN DEL DIV DE LA CARD -->
            @endforeach
            <!-- PAGINACIÓN -->
            <div class="clearfix"></div>
            {{$images->links()}}
        </div>

    </div>
</div>
@endsection
