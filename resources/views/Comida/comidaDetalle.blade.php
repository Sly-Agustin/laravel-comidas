@extends('plantilla')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/comida.css') }}">
<link rel="stylesheet" href="{{ asset('css/receta.css') }}">

@section('seccion')
<main class="py-4 fontRoboto">
<div class="row">
    <div class="col-sm-9">
        <div class="container py-4">
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

            <h2 class="font-weight-bold text-center text-uppercase py-2"> {{$comida->nombre}} </h2>
            @if ($comida->imagen!=null)
            <div>
            <img src="data:image/png;base64,{{$comida->imagen}}" class="py-4 mx-auto d-block img-fluid" alt="{{$comida->nombre}}img">
            </div>
            @else
            <p>No hay imágen disponible, puedes <a href="#multiCollapseExample2" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">agregar una</a></p>
            <div class="collapse multi-collapse" id="multiCollapseExample2">
                <div class="card card-body">
                    <form action="{{ route('comida.updateFoto', $comida->id_comida) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="imagen" accept="image/*" class="px-2 py-2">
                    <button type="submit" id="agregarFotoButton" class="normalButton rounded active">Agregar foto</button>
                    </form>
                </div>
            </div>        
            @endif
            @if ($comida->ubicacion!=null)
            <p class="py-4">Origen: {{$comida->ubicacion}} </p>
            @endif
            @if ($comida->descripcion!=null)
            <p> Descripcion: {{$comida->descripcion}}</p>
            @else
            <p>La comida aun no tiene descripción.</p>
            <a class="nav" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Agrégale una!</a>
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <form action="{{ route('comida.updateDescripcion', $comida->id_comida) }}" method="POST">
                    @csrf
                    <input type="text" name="descripcion" class="form-control" id="inputDescripcion" placeholder="Descripcion">
                    <button type="submit" id="agregarDescripcionButton" class="normalButton rounded active">Agregar descripcion</button>
                    </form>
                </div>
            </div>
            @endif

            @if (Auth::user())
                @if(Auth::user()->isAdmin)
                    <a href="{{ route('comida.modificar', $comida->id_comida) }}">
                        Modificar
                    </a>
                @endif
            @endif

        </div>
        @if ($comida->video!=null)
        <div class="container"> 
            <div class="embed-responsive embed-responsive-16by9">     
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$comida->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        @endif
    </div> <!--Col 9-->
    <div class="col-sm-3 border-left">
        <div class="container">
            <h2>Recetas para esta comida:</h2>   
            @if($recetas->isEmpty())
                <p class="mt-4"> No hay recetas, <a href="{{ route('receta.crear', $comida->id_comida)}}">crea una!</a></p>
            @else
                <ul class="list-group">
                @foreach ($recetas as $receta)
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('receta.detallado', [$comida->id_comida, $receta->id_receta])}}" class="text-decoration-none">Receta de: {{$receta->usuario_nombre}}</a>
                        @if ($receta->cantidadVotos==0)
                        <span class="badge badge-colorBackground badge-pill">No hay puntuación</span>
                        @else
                        <span class="badge badge-colorBackground badge-pill">★ <?php echo $receta->puntuacionTotal/$receta->cantidadVotos?></span>
                        @endif
                    </li>
                               
                @endforeach
                </ul>
                <div class="py-4">
                    {{ $recetas->links() }}
                </div>
                <p class="mt-4 p-2 border-top">Ninguna te convence? Conocés una manera de hacerlo vos? <a href="{{ route('receta.crear', $comida->id_comida)}}">Crea una receta!</a></p>
            @endif
        </div>
    </div>
</div> <!--Row-->
</main>
@endsection