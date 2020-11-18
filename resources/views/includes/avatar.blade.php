<!-- SI EL USUARIO LOGADO TIENE IMAGEN PERSONAL EN SU PERFIL LA MUESTRA-->
@if(Auth::user()->image)
    <div class='container-avatar'>
        <img src="{{route('user.avatar',['filename'=>Auth::user()->image])}}" class="avatar">
    </div>    
@else  <!-- SI EL USUARIO NO TIENE IMAGEN PERSONAL EN SU PERFIL MUESTRA UNA SILUETA MUÑECO-->
<div class="container-avatar">
    <img src="{{asset('images/avatar.jpg')}}" class="avatar">
</div>
@endif