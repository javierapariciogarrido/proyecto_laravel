@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.mensaje') <!-- AQUI SE MUESTRA EL MENSAJE FLASH -->
            @foreach($images as $image)
                <div class="card imagen_publicada">
                    <div class="card-header">
                                                
                        @if($image->user->image) {{--SI EL USUARIO TIENE IMAGEN LA MUESTRA--}}
                            <div class='container-avatar'>
                                <img src="{{route('user.avatar',['filename'=>$image->user->image])}}" class="avatar">
                            </div>
                        @endif 
                        <div class="data-user">
                            {{$image->user->name.''.$image->user->surname}}
                            <span class="nickname">
                                {{' | @'.$image->user->nick}}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        {{--AQUI MOSTRAMOS LA IMAGEN QUE SUBE EL USUARIO--}}
                        <div class="image-container">
                            <img src="{{route('image.file',['filename'=>$image->image_path])}}">
                        </div>
                        <div class="likes">
                            
                        </div>
                        
                        <div class="description">
                            <span class="nickname">
                                {{'@'.$image->user->nick}}
                            </span>
                            <p>{{$image->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
