@extends('plantilla')

@section('seccion')
<main class="py-4 fontRoboto">
    <div class="container">     
        <!--Errores de validación-->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif 
        
        <!--Descripcion actualizada correctamente-->
        @if (session('mensaje'))
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif
        <!--En caso de no estar logueado y querer agregar descripciones va a venir un mensaje informando 
        que debe loguearse, esto lo muestra-->
        @if (session('mensajeLogin'))
            <div class="alert alert-danger">
                {{ session('mensajeLogin') }}
            </div>
        @endif
        <!--Mensaje de error en caso de querer realizar algo y que no tenga permiso de administrador, viene por un session y no por
        un error porque viene directamente del middleware IsAdmin. Por ahora no hay ninguna opcion que requiera a un administrador 
        acá, sacarlo?-->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="font-weight-bold text-center text-uppercase py-4"> {{$datos->nombre}} </h2>
        @if ($datos->imagen!=null)
        <img src="data:image/png;base64,{{$datos->imagen}}" class="py-2 d-inline-block float-right img-thumbnail w-50 h-50" alt="{{$datos->nombre}}img">
        @else
        <p>No hay imágen disponible, puedes agregar una con el boton de abajo</p>        
        @endif
        @if ($datos->ubicacion!=null)
        <p class="py-4">Ubicación: {{$datos->ubicación}} </p>
        @endif
        @if ($datos->descripcion!=null)
        <p> Descripcion: {{$datos->descripcion}}</p>
        @else
        <p>El ingrediente aun no tiene descripción.</p> 
        <a class="nav" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Agrégale una!</a>
        <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
                <form action="{{ route('ingrediente.updateDescripcion', $datos->id_ingrediente) }}" method="POST">
                @csrf
                <input type="text" name="descripcion" class="form-control" id="inputDescripcion" placeholder="Descripcion">
                <button type="submit" id="agregarDescripcionButton" class="normalButton rounded active">Agregar descripcion</button>
            </div>
        </div>
        @endif
        @if ($datos->caracteristicas!=null)
        <p>Características: {{$datos->caracteristicas}} </p>
        @endif
    </div>
</main>
@endsection