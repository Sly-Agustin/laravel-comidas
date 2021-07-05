@extends('plantilla')

@section('seccion')
<main class="py-4 fontRoboto">
    <div class="container">
        <h1 class="text-center">Modificando {{$comida->nombre}}</h1>
        <div class="text-center">
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
            <div class="text-left">
            <p class="font-weight-bold">Instrucciones:</p>
            <p>No es necesario llenar todos los campos, si solo se quiere modificar una cosa se modifica esa sola</p>
            <p>La imagen debe ser una imagen válida (png, jpg, etc). Se rechazarán aquellos que no cumplan como exes, doc, etc</p>
            <p>El video en youtube puede ser en los siguientes formatos</p>
            <p>&nbsp&nbsp&nbsp&nbsp1- https://www.youtube.com/watch?v=7tUyizxQwKM</p>
            <p>&nbsp&nbsp&nbsp&nbsp2- https://youtu.be/7tUyizxQwKM</p>
            <p>&nbsp&nbsp&nbsp&nbsp3- youtu.be/7tUyizxQwKM </p>
            </div>
            <form action="{{route('comida.update', $comida->id_comida)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Descripcion del comida</label>
                        <textarea type="text" name="descripcionComida" class="form-control" id="inputDescripcion" >{{$comida->descripcion}}</textarea>
                    </div>     
                    <div class="form-group col-md-6">
                        <label>Ubicación</label>
                        <input type="text" name="ubicacionComida" class="form-control" id="inputUbicacion" value="{{$comida->ubicacion}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Video</label>
                        <input type="text" name="videoComida" class="form-control" id="inputVideo" value="https://youtu.be/{{$comida->video}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Es visible al resto de los usuario? (Es decir está baneado o no)</label>
                        @if ($comida->isVisible)
                        <select name="visibilidadComida" class="form-control form-control-sm">
                            <option value="1">Visible</option>
                            <option value="0">Invisible</option>
                        </select>
                        @else
                        <select name="visibilidadComida" class="form-control form-control-sm">
                            <option value="0">Invisible</option>
                            <option value="1">Visible</option>
                        </select>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="imagen">Actualizar imagen</label>
                        <input type="file" name="imagen" accept="image/*" class="px-2 py-2">
                        <div>{{ $errors->first('image') }}</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="agregarProductoButton" class="normalButton rounded btn-lg active">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection