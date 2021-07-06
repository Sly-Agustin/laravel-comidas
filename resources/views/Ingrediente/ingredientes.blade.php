@extends('plantilla')

@section('seccion')
<main class="py-4 fontRoboto">
    <div class="d-flex" id="wrapper">
        <!--Sidebar-->
        <div class="bg-transparent border-right px-2 py-2" id="sidebar-wrapper">
            <div class="sidebar-heading text-center font-weight-bold">Tipos de ingredientes </div>
            <!--Esto debería ser un foreach y usar php por cada tipo, hacerlo cuando se modifiquen los seeders-->
            <div class="list-group list-group-flush">
                    <a href="{{route('ingrediente.filtro', 'especia')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Especias</a>
                    <a href="{{route('ingrediente.filtro', 'carne')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Carnes</a>
                    <a href="{{route('ingrediente.filtro', 'aceite')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Aceites</a>
                    <a href="{{route('ingrediente.filtro', 'lacteo')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Lacteos</a>
                    <a href="{{route('ingrediente.filtro', 'fiambre')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Fiambres</a>
                    <a href="{{route('ingrediente.filtro', 'arroz')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Arroz</a>
                    <a href="{{route('ingrediente.filtro', 'legumbre')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Legumbre</a>
                    <a href="{{route('ingrediente.filtro', 'fruta')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Fruta</a>
                    <a href="{{route('ingrediente.filtro', 'verdura')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Verdura</a>
                    <a href="{{route('ingrediente.filtro', 'alcohol')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Alcohol</a>
                    <a href="{{route('ingrediente.filtro', 'harina')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Harina</a>
                    <a href="{{route('ingrediente.filtro', 'otro')}}" class="list-group-item list-group-item-action bg-transparent border-secondary">Otro</a>
                    <a href="" class="list-group-item list-group-item-action bg-transparent border-secondary"></a>
            </div>
        </div>

        <!--Lista-->
        <div class="container">
            <h1 class="text-center text-secondary">Lista completa de ingredientes</h1> 
            <div>
                <p>Si no encontras el ingrediente que buscas podes crearlo haciendo <a href="{{route('ingrediente.crear')}}">click aquí</a></p>
                @if (Auth::user())
                    @if(Auth::user()->isAdmin)
                <p>Para ver los ingredientes baneados <a href="{{route('ingrediente.baneados')}}">haz click aquí</a></p>
                    @endif
                @endif
            </div> 
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo</th>       
                            <th scope="col">Ubicacion</th>
                            <th scope="col">Características</th>
                            <th scope="col">Link</th>
                            <th scope="col">Imagen</th>
                            @if (Auth::user())
                                @if(Auth::user()->isAdmin)
                            <th scope="col">Modificar ingrediente</th>
                                @endif
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ingredientes as $item)           
                        <tr>
                        <th scope="row">{{$item->nombre}}</th>
                        <td>{{$item->tipo}}</td>
                        <td>{{$item->ubicacion}}</td>
                        <td>{{$item->caracteristicas}}</td>
                        <td>
                            <a href="{{route('ingrediente.detallado', $item->id_ingrediente)}}">
                                {{$item->nombre}}
                            </a>
                        </td>

                        <!--Imágenes-->
                        @if ($item->imagen!=null)
                        <td><img width="100" height="60" src="data:image/png;base64,{{$item->imagen}}" class="d-inline-block align-center" alt="{{$item->nombre}}img"></td>
                        @else
                        <td>No hay imagen disponible</td>
                        @endif
                        @if (Auth::user())
                            @if(Auth::user()->isAdmin)
                                <td>
                                    <a href="{{route('ingrediente.modificar', $item->id_ingrediente)}}">
                                        Modificar
                                    </a>
                                </td>
                            @endif
                        @endif
                        </tr>
            
                        @endforeach
                    </tbody>
                </table>  
                <div> 
                
            </div> 
        </div>
        </div>
</main>
@endsection