@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('includes.mensaje') <!-- AQUI SE MUESTRA EL MENSAJE FLASH -->
            <!-- AQUI RECORREMOS LA VARIABLE IMAGES QUE NOS VIENE DEL CONTROLADOR HOME -->

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

                    <div class="data-user-detail">
                        {{$image->user->name.''.$image->user->surname}}
                        <span class="nickname">
                            {{'|@'.$image->user->nick}}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <!--AQUI MOSTRAMOS LA IMAGEN QUE SUBE EL USUARIO-->
                    <div class="image-container-detail">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}">
                    </div>

                    <div class="description">
                        <span class="nickname">
                            {{'Imagen subida por @'.$image->user->nick}}
                        </span>
                        <span class="nickname">{{'|'.FormatTime::LongTimeFilter($image->created_at)}}</span>
                        <p>{{$image->description}}</p>
                    </div>
                    <div class="container-comentarios-likes-detail">
                        <!--<h2>Comentarios({{count($image->comments)}})</h2>-->
                                                
                        <div class="likes">
                            <img  src="{{asset('images/corazon_gris.png')}}">
                        </div>
                        
                    </div>
                    <div class="formulario-comments">
                        <!-- <hr> -->
                        <!-- FORMULARIO PARA QUE USUARIO LOGADO HAGA COMENTARIO DE LA IMAGEN -->
                        <form method="POST" action="{{route('comment.save')}}">
                            @csrf
                            <!-- COJO EL CAMPO image_id Y user_id QUE PASO POR POST A ACCION COMENTARIO-->                       
                            <input type="hidden" value="{{$image->id}}" name="image_id">
                            <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                            <p>
                                <textarea  id="content" name="content" class="form-control @error('content') is-invalid @enderror" placeholder="Añade un comentario..."></textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{ $message }}</strong>
                                </span>
                            @enderror
                            </p>
                            
                            
                            <input type="submit" value="Publicar" class="btn btn-success">
                        </form>
                        <hr>
                        <h2>Comentarios({{count($image->comments)}})</h2>
                        @foreach($image->comments as $comment)
                        <div class="comment">
                            <span class="nickname">
                                {{'Comentario echo por @'.$comment->user->nick}}
                            </span>
                            <span class="nickname">
                                {{'|'.FormatTime::LongTimeFilter($comment->created_at)}}
                            </span>
                            <p>{{$comment->content}}</p>
                        </div>    
                        @endforeach
                    </div>    
                </div>
            </div> <!-- FIN DEL DIV DE LA CARD -->

        </div>

    </div>
</div>
@endsection
