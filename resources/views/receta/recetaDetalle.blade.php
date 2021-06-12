@extends('plantilla')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/comida.css') }}">
<link rel="stylesheet" href="{{ asset('css/receta.css') }}">
<link rel="stylesheet" href="{{ asset('css/recetaRate.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

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
        <!--Receta creada correctamente-->
        @if (session('mensaje'))
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif

        <h2>{{$comida->nombre}}</h2>
        <div class="row">
            <div class="col-sm-9">
                @if($receta->video!=null)
                <div class="py-4">
                <h3 class="borderHr py-2">Video explicativo</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$receta->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                </div>
                @endif
                <div class="py-4">
                @foreach($pasos as $paso)
                    <h3 class="borderHr py-2">Paso {{$paso->numeroDePaso}}: {{$paso->titulo}}</h3>
                    <textarea class="form-control" rows="3" disabled>{{$paso->descripcion}}</textarea>
                @endforeach
                </div>
                <hr>
                @if($voto->isEmpty())

                <div class="card-body text-center">
                <p>Que te pareció esta receta?</p>
                    <form method="POST" action="{{route('receta.votar', [$comida->id_comida, $receta->id_receta])}}">
                        @csrf 
                    <div class="form-group">
                        <input class="star star-5" id="star-5" type="radio" name="star" value="5"/> <label class="star star-5" for="star-5"></label> 
                        <input class="star star-4" id="star-4" type="radio" name="star" value="4"/> <label class="star star-4" for="star-4"></label> 
                        <input class="star star-3" id="star-3" type="radio" name="star" value="3"/> <label class="star star-3" for="star-3"></label> 
                        <input class="star star-2" id="star-2" type="radio" name="star" value="2"/> <label class="star star-2" for="star-2"></label> 
                        <input class="star star-1" id="star-1" type="radio" name="star" value="1"/> <label class="star star-1" for="star-1"></label> 
                    </div>

                    <div class="form-group row mb-0">
                        <button type="submit" class="normalButton rounded btn-lg active">
                            Enviar puntuación
                        </button>
                    </div>
                    </form>
                </div>
                @else
                <p>Ya votaste esta receta</p>
                @endif
            </div>
            <div class="col-sm-3 border-left">
                <h4 class="py-2 borderHr">Ingredientes necesarios:</h4>
                <div class="py-4">       
                @foreach($seUtilizan as $ingredientes)
                <li class="listaIngredientes">
                        <span class="text-uppercase"><span>{{$ingredientes->nombreIngrediente}} </span></span>
                        <span class="ingredienteCantidad font-weight-bold">{{$ingredientes->cantidad}} <abbr title=""></abbr></span>
                </li>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript" src="{{ asset('js/recetaRate.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection