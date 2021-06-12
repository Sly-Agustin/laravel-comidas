@extends('plantilla')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/comida.css') }}">

@section('seccion')
<main class="py-4 fontRoboto">
    <div class="container">
        <h1 class="text-center">Crear nueva comida</h1>
        <hr>
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
            <!--Comida actualizada correctamente-->
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
        <div class="container containerBg rounded">
            <p>Nombre: Obligatorio, cualquier combinación de caracteres</p>
            <p>Descripcion: Opcional, descripción básica de la comida</p>
            <p>Ubicación: Opcional, lugar de origen de la comida</p>
            <p>Video: Opcional, puede mostrar la preparación del mismo o mostrando la comida en sí. También puede ser un video informativo</p>
            <p>Imagen: Opcional, debe ser una imagen válida (jpg, png, etc) e ilustrativa de la comida ya preparada</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulario</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('comida.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre de comida</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comidaDescripcion" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                                <div class="col-md-6">
                                    <input id="comidaDescripcion" type="text" class="form-control" name="comidaDescripcion" value="{{ old('comidaDescripcion') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comidaUbicacion" class="col-md-4 col-form-label text-md-right">Ubicación</label>
                                <div class="col-md-6">
                                    <input id="comidaUbicacion" type="text" class="form-control" name="comidaUbicacion" value="{{ old('comidaUbicacion') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comidaVideo" class="col-md-4 col-form-label text-md-right">Video</label>
                                <div class="col-md-6">
                                    <input id="comidaVideo" type="text" class="form-control" name="comidaVideo" value="{{ old('comidaVideo') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="imagen" class="col-md-4 col-form-label text-md-right">Imagen</label>
                                <div class="col-md-6">   
                                    <input type="file" name="imagen" accept="image/*" class="px-2 py-2">
                                </div>
                                <div>{{ $errors->first('image') }}</div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="normalButton rounded btn-lg active">
                                        Crear comida
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection