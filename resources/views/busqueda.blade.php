@extends('plantilla')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/comida.css') }}">
@endsection

@section('seccion')
<main class="fontRoboto py-4">
    <div class="container">
        @if($ingredientes==null && $comidas==null)
        <p>No se han registrado resultados compatibles con su busqueda</p>
        @else
        <h1 class="text-center text-secondary">Resultados de la búsqueda</h1>  
        <h2>Comidas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Link</th>
                    <th scope="col">Imagen</th>
                    @guest
                    @else
                    <th scope="col"></th>
                    @endguest
                </tr>
            </thead>
            <tbody>
                @foreach($comidas as $comida)           
                <tr>
                <th scope="row">{{$comida->nombre}}</th>
                <td>{{$comida->ubicacion}}</td>
                <td>
                    <a href="{{route('comida.detallado', $comida->id_comida)}}">
                        {{$comida->nombre}}
                    </a>
                </td>

                <!--Imágenes-->
                @if ($comida->imagen!=null)
                <td><img width="100" height="60" src="data:image/png;base64,{{$comida->imagen}}" class="d-inline-block align-center" alt="{{$comida->nombre}}img"></td>
                @else
                <td>No hay imagen disponible</td>
                @endif
                </tr>

                
                @endforeach
            </tbody>
        </table>  
        <div> 
        {{ $comidas->links() }}
        </div> 

        <h2 class="py-4">Ingredientes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Link</th>
                    <th scope="col">Imagen</th>
                    @guest
                    @else
                    <th scope="col"></th>
                    @endguest
                </tr>
            </thead>
            <tbody>
                @foreach($ingredientes as $ingrediente)           
                <tr>
                <th scope="row">{{$ingrediente->nombre}}</th>
                <td>{{$ingrediente->tipo}}</td>
                <td>
                    <a href="{{route('ingrediente.detallado', $ingrediente->id_ingrediente)}}">
                        {{$ingrediente->nombre}}
                    </a>
                </td>

                <!--Imágenes-->
                @if ($ingrediente->imagen!=null)
                <td><img width="100" height="60" src="data:image/png;base64,{{$ingrediente->imagen}}" class="d-inline-block align-center" alt="{{$ingrediente->nombre}}img"></td>
                @else
                <td>No hay imagen disponible</td>
                @endif
                </tr>

                
                @endforeach
            </tbody>
        </table>  
        <div> 
        {{ $ingredientes->links() }}
        </div>  
        @endif
    </div>
</main>
@endsection