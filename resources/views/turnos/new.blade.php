<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restaurante La Mirilla de Edy en Madrid - Restaurante, Comer, Cenar, Desayunar, Café, Alérgenos, Madrid</title>
    <meta
        content="Bienvenido a nuestro restaurante ubicado cerca del centro comercial H2Ocio, en el que disfrutaras de amables camareros y deliciosa comida.
    Desayunos, comidas, almuerzos, cenas o a la hora que prefieras estaremos encantados de recibirte y servirte con nuestros deliciosos productos."
        name="description">
    <meta content="restaurante, comida, calidad, precio, madrid, desayunos, almuerzos, comidas, cenas" name="keywords">
    <link href="{{asset('images/logo-corto.jpg')}}" rel="icon">

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/boxicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/glightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>
<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
        <a href="https://www.instagram.com/restaurantelamirilladeedy/"><i style="font-size: 23px;"
                                                                          class="bi bi-instagram ms-4 d-none d-lg-flex align-items-center"></i></a>
        <a href="https://www.facebook.com/profile.php?id=100086663724470"><i style="font-size: 23px;"
                                                                             class="bi bi-facebook ms-4 d-none d-lg-flex align-items-center"></i></a>
        <i class="bi bi-phone ms-4 d-none d-lg-flex align-items-center d-none"><a style="color: white;" class="ps-1"
                                                                                  href="tel:919 47 72 18">919 47 72 18</a></i>
        <i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"><span>Lunes a Viernes: 07.00-00.00 y Sábado
          08.00-00.00</span></i>
    </div>
</section>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <div class="logo me-auto">
            <h1><a href="/">La Mirilla de Edy</a></h1>
        </div>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active" href="/">Inicio</a></li>
                @if($categorias)
                    @foreach($categorias as $categoria)
                        <li><a class="nav-link scrollto" href="#{{strtolower($categoria->name)}}">{{$categoria->name}}</a></li>
                    @endforeach
                @endif
                <li><a class="nav-link scrollto" href="#contact">Visítanos</a></li>
                @if($authenticated)
                    <li><a class="nav-link" href="/users">Bienvenido {{Auth::user()->name}}</a></li>
                    <li><a class="nav-link" href="/reservas">Ver Reservas</a></li>
                    <li><a class="nav-link" href="/reservar">Reservar</a></li>
                    <li><a class="nav-link" href="/logout">Cerrar Sesión</a></li>
                    @if(Auth::user()->rol == 0)
                        <li><a class="nav-link" href="/dashboard">Dashboard</a></li>
                    @endif
                @else
                    <li><a class="nav-link" href="/login">Iniciar Sesión</a></li>
                @endif
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>
{{--Content--}}
@if(Auth::user()->rol == 0)
    <div class="container" style="margin-top: 200px;">
        <div class="row">
            <div class="col-6 offset-3">
                <form method="POST" action="{{ route('turnos.store') }}">
                    @csrf
                    <div>
                        <label for="hora">Hora del turno:</label>
                        <input type="text" name="hora" id="hora" value="{{ old('hora') }}" required>
                        @error('hora')
                        <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit">Enviar</button>
                </form>

            </div>
        </div>
    </div>
@else
    <h1>Carece del permiso para acceder a esta página.</h1>
@endif
{{--End of Content--}}
<!-- ======= Contacto ======= -->
<section id="contact" class="contact">
    <div class="container">
        <div class="section-title">
            <h1><span>Visítanos</span></h1>
        </div>
    </div>
    <div class="map">
        <iframe style="border:0; width: 100%; height: 350px;"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3041.448443807971!2d-3.52619454857389!3d40.33239697927385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd423c747175f797%3A0x46839154032c7ee4!2sC.%20Mariano%20Barbacid%2C%205%2C%2028521%20Rivas-Vaciamadrid%2C%20Madrid!5e0!3m2!1sen!2ses!4v1666384214237!5m2!1sen!2ses"
                allowfullscreen frameborder="0"></iframe>
    </div>
</section>
<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <img src="assets/img/logo largo.jpg" class="img-fluid p-2 pt-0" style="max-width: 50%;">
        <div class="copyright">
            &copy;<strong><span> La Mirilla de Edy</span></strong>. Todos los derechos reservados
        </div>
        <div class="credits">
            Designed by RCM
        </div>
    </div>
</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/glightbox.min.js')}}"></script>
<script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('js/swiper-bundle.min.js')}}"></script>
<script src="{{ asset('js/validate.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>


</body>
</html>
