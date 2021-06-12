@extends('plantilla')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/ingrediente.css') }}">

@section('seccion')
<main class="fontRoboto py-4">
    <div class="container">
        <h1 class="text-center">Crear nuevo ingrediente</h1>
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
            <p>Nombre: Obligatorio, cualquier combinación de caracteres.</p>
            <p>Descripcion: Opcional, descripción básica del ingrediente.</p>
            <p>Caracteristicas: Opcional, cosas especiales sobre el ingrediente como dulzor, picor, algo en particular que se desee comunicar sobre el mismo. Separadas por comas</p>
            <p>Ubicación: Opcional, lugar de origen o fabricación.</p>
            <p>Tipo: Obligatorio, que tipo de ingrediente es, debe seleccionarse de una lista.</p>
            <p>Imagen: Opcional, debe ser una imagen válida (jpg, png, etc) e ilustrativa del ingrediente.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulario</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('ingrediente.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre del ingrediente</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ingredienteDescripcion" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                                <div class="col-md-6">
                                    <input id="ingredienteDescripcion" type="text" class="form-control" name="ingredienteDescripcion" value="{{ old('ingredienteDescripcion') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ingredienteCaracteristicas" class="col-md-4 col-form-label text-md-right">Características</label>
                                <div class="col-md-6">
                                    <input id="ingredienteCaracteristicas" type="text" class="form-control" name="ingredienteCaracteristicas" value="{{ old('ingredienteCaracteristicas') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ingredienteUbicacion" class="col-md-4 col-form-label text-md-right">Ubicación</label>
                                <div class="col-md-6">
                                    <input id="ingredienteUbicacion" type="text" class="form-control" name="ingredienteUbicacion" value="{{ old('ingredienteUbicacion') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ingredienteTipo" class="col-md-4 col-form-label text-md-right">Tipo</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="ingredienteTipo" id="ingredienteTipo">
                                        <option value="especia">Especia</option>
                                        <option value="carne">Carne</option>
                                        <option value="aceite">Aceite</option>
                                        <option value="lacteo">Lacteo</option>
                                        <option value="fiambre">Fiambre</option>
                                        <option value="arroz">Arroz</option>
                                        <option value="legumbre">Legumbre</option>
                                        <option value="fruta">Fruta</option>
                                        <option value="verdura">Verdura</option>
                                        <option value="alcohol">Alcohol</option>
                                        <option value="harina">Harina</option>
                                        <option value="otro">Otro</option>
                                    </select>
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