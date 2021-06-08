@extends('plantilla')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/comida.css') }}">
<link rel="stylesheet" href="{{ asset('css/receta.css') }}">

@section('seccion')
<main class="py-4 fontRoboto">
    <div class="container">
        <h1 class="text-center">Creando una receta de {{$comida->nombre}}</h1>
        <hr class="my-4">
        <div class="container containerBg rounded p-2">
            <p>Ingredientes: Obligatorio, seleccionar de la lista y especificar las cantidades en la unidad correspondiente (ml, cucharadas, gr, etc).</p>
            <p>Pasos: Obligatorio, mínimo uno necesario. Para realizar la receta, cada paso debe tener un título y un cuerpo que explique que hacer. Pueden agregarse nuevos pasos con el botón "Agregar paso"</p>
            <p>Video: Opcional, debe mostrar la preparación del mismo. Solo se aceptan videos de youtube.</p>
        </div>
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
        <!--Receta creada correctamente-->
        @if (session('mensaje'))
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif
        <!--Mensajes de error-->
        @if (session('mensajeError'))
            <div class="alert alert-danger">
                {{ session('mensajeError') }}
            </div>
        @endif

            <div id="divIngredientes">
                <label id="labelIngredientes">Agregar ingredientes</label>
                <input type="text" id="inputCantidadIngredientes">
                <input type="button" class="normalButton rounded" value="Agregar" id="botonIngredientes" onclick="load({{$ingredientes}})">
            </div>
            <form method="POST" action="{{route('receta.store', $comida->id_comida)}}" enctype="multipart/form-data">
            @csrf
            <div id="divIngredientes2">
                <!--Esto lo modifica la función load() cuando se quieran agregar ingredientes-->
            </div>
            
            <div id="divPasos">
                <label id="labelPasos">Pasos a realizar</label>
                <input type="button" class="normalButton rounded" value="Agregar paso" id="botonIngredientes" onclick="crearPaso()">
            </div>
            <div id="divPasos2">
                <!--Esto lo modifica la función crearPaso() cuando se quieran agregar pasos-->
            </div>

            <div class="form-group py-4">
                <label>Video</label>
                <input type="text" name="videoComida" class="form-control" id="inputVideo" value="{{ old('videoComida') }}">
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="normalButton rounded btn-lg active">
                        Crear receta
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</main> 

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/receta.js') }}"></script>
@endsection