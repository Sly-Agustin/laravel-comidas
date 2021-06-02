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
        <div class="row">
            @foreach($comidas as $comida)
            <div class="col-sm-4">
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
            </div>
            @endforeach
        </div>
        <div class="py-4">
            {{ $comidas->links() }}
        </div>
    </div>
</main>
@endsection