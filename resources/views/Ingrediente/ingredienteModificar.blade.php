@extends('plantilla')

@section('seccion')
<main class="py-4 fontRoboto">
    <div class="container">
        <h1 class="text-center">Modificando {{$ingrediente->nombre}}</h1>
        <div class="text-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
            <!--Ingrediente actualizado correctamente-->
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
            <form action="{{route('ingrediente.update', $ingrediente->id_ingrediente)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Descripcion del ingrediente</label>
                        <textarea type="text" name="descripcionIngrediente" class="form-control" id="inputDescripcion" placeholder="{{$ingrediente->descripcion}}" value="{{ old('descripcionIngrediente') }}"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tipo</label>
                        <select class="form-control" name="tipoIngrediente" id="ingredienteTipo">
                            <option value="default">Seleccione una opcion</option>
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
                    <div class="form-group col-md-6">
                        <label>Ubicación</label>
                        <input type="text" name="ubicacionIngrediente" class="form-control" id="inputUbicacion" placeholder="{{$ingrediente->ubicacion}}" value="{{ old('ubicacionIngrediente') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Caracteristicas</label>
                        <input type="text" name="caracteristicasIngrediente" class="form-control" id="inputCaracteristica" placeholder="{{$ingrediente->caracteristicas}}" value="{{ old('caracteristicasIngrediente') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Es visible al resto de los usuario? (Es decir está baneado o no)</label>
                        <select name="visibilidadIngrediente" class="form-control form-control-sm">
                            <option value="1">Visible</option>
                            <option value="0">Invisible</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="imagen">Actualizar imagen</label>
                        <input type="file" name="imagen" class="px-2 py-2">
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