@extends('plantilla')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/comida.css') }}">
@endsection
@section('seccion')
<main class="py-4 fontRoboto">
    <div class ="container border-right border-left">
        <h2 class="text-center py-4">Comidas</h2>
        <p>Aquí se encuentran todas las comidas disponibles.</p>
        <p>Para recetas con ingredientes específicos o comidas específicas puede utilizar el buscador que se encuentra arriba</p>
        <p>Haga click en una comida para ver sus recetas disponibles y otras cosas interesantes sobre ellas</p>
        @if (Auth::user())
        <p class="d-inline">¿Querés agregar una comida que no aparezca?</p>
        <a href="{{ route('comida.crear') }}" role="button" class="passiveButton rounded mr-2 text-decoration-none">Agregar comida</a>
        @else
        <p class="d-inline">¿Querés agregar una comida que no aparezca? Es necesario estar logueado ¿No tenes cuenta?</p>
        <a href="{{ route('register') }}" role="button" class="passiveButton rounded mr-2 text-decoration-none">Crea una cuenta!</a>
        @endif
        <div class="row">
            @foreach($comidas as $comida)
            <div class="col-sm-4">
                <a href="{{route('comida.detallado', $comida->id_comida)}}" class="text-reset text-decoration-none">
                <div class="card bg-transparent">
                    @if($comida->imagen!=null)
                    <img width="200" height="200" class="card-img-top img" src="data:image/png;base64,{{$comida->imagen}}" alt="imagen no disponible">
                    @else
                    <p class="text-center">No hay imagen disponible</p>
                    @endif
                    <div class="card-body">
                        <h3 class="card-title">{{$comida->nombre}}</h3>
                        <p>{{$comida->descripcion}}</p>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="py-4">
            {{ $comidas->links() }}
        </div>
    </div>
</main>
@endsection