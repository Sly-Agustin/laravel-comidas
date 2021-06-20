<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        @yield('stylesheets')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">
        <link rel="stylesheet" href="{{ asset('css/button.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        </style>
    </head>

  <body>
    <!--Header-->
    <nav id="header" class="navbar navbar-expand-sm bgHeader p-2 bgBlack shadow-sm fontRoboto">
        <a class="navbar-brand" href="{{ route('inicio') }}"> <img width="50" height="50" id="logo" src="{{url('/images/logo2.png')}}" class="d-inline-block align-center" alt="hardstoreimg"></a>
        Gourmet Cooking
        <div class="container d-flex justify-content-end">
            <nav class="navbar navbar-light">
                <div class="container-fluid">
                    <form action="{{ route('busqueda') }}" class="d-flex" method="POST">
                        @csrf
                        <input class="form-control me-2" name="busqueda" type="search" placeholder="Buscar comida/ingrediente" aria-label="Buscar">
                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>
        </div>
        <div class="container d-flex justify-content-end">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('comida.comida')}}">
                    Comidas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ingrediente.ingredientes')}}">
                    Ingredientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    Sobre nosotros
                    </a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav flex-row ml-md-auto d-gone d-md-flex text-decoration-none">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" role="button" class="loginButton rounded mr-2 text-decoration-none">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="loginButton rounded text-decoration-none" role="button" aria-pressed="true">Registrarse</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        
                        <a class="dropdown-item" href="{{ route('usuario.logout') }}"
                            onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('usuario.logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </nav>

    @yield('seccion')
    @yield('aside')

    <!--Footer-->
    <footer id="footer" class="footer bgFooter fixed-bottom fontRoboto" >
        <div class="row text-black">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="footerTitulo text-black font-weight-bold" id="contactoFooter">
                    <p>Contacto:</p>
                </div>
                <div class="text-black" id="telFooter">
                    Tel: +54 291 456-6789
                </div>
                <div class="text-black" id="mailFooter">
                    gourmetcooking221@gmail.com
                </div>
                
            </div>
            
            <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                <p>Seguinos en nuestras redes!</p>    
                <a class="navbar-link whiteColor" href="" target="_blank" rel="noreferrer" aria-label="GitHub"><img width="60" id="facebook" src="{{url('images/facebook.png')}}" class="facebookImgInverted" alt="faceimg"></a> <!--El noreferrrer se utiliza por cuestiones de seguridad-->
                <a class="navbar-link whiteColor" href="" target="_blank" rel="noreferrer" aria-label="GitHub"><img width="60" id="twitter" src="{{url('images/twitter.png')}}" class="twitterImgInverted" alt="twitimg"></a>
                <a class="navbar-link whiteColor" href="" target="_blank" rel="noreferrer" aria-label="GitHub"><img width="60" id="instagram" src="{{url('images/instagram.png')}}" class="instagram" alt="instagramimg"></a>         
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 text-right">
                <div>Iconos diseñados por <a href="https://www.flaticon.es/autores/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.es/" title="Flaticon">www.flaticon.es</a></div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    @yield('imports')
  </body>
</html>