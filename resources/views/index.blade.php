<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restaurante La Mirilla de Edy en Madrid - Restaurante, Comer, Cenar, Desayunar, Café, Alérgenos,
        Madrid</title>
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
@if(!$categorias)
    <script type="text/javascript">
        window.location = "{{url('/categorias/create')}}";//here double curly bracket
    </script>
@else
    <body>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
        <div
            class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
            <a href="https://www.instagram.com/restaurantelamirilladeedy/"><i style="font-size: 18px;"
                                                                              class="bi bi-instagram ms-4 d-none d-lg-flex align-items-center"></i></a>
            <a href="https://www.facebook.com/profile.php?id=100086663724470"><i style="font-size: 18px;"
                                                                                 class="bi bi-facebook ms-4 d-none d-lg-flex align-items-center"></i></a>
            <i class="bi bi-phone ms-4 d-none d-lg-flex align-items-center d-none"><a style="color: white;" class="ps-1"
                                                                                      href="tel:919 47 72 18">919 47 72
                    18</a></i>
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
                            <li><a class="nav-link scrollto"
                                   href="#{{strtolower($categoria->name)}}">{{$categoria->name}}</a></li>
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
    <!-- ======= Carousel ======= -->
    <section id="hero">
        <div class="hero-container">
            <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

                <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">

                    <!-- Slide 1 -->
                    <div class="carousel-item active" style="background-image: url({{ asset('images/barra.jpg') }});">
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2 class="animate__animated animate__fadeInDown">
                                    <span>Restaurante la Mirilla de Edy</span></h2>
                                <p class="animate__animated animate__fadeInUp"></p>
                                <div>
                                    <a href="#menú" class="btn-menu animate__animated animate__fadeInUp scrollto">Nuestra
                                        Carta</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--Content--}}
    @if ($categorias)
        @foreach ($categorias as $categoria)
            <section id="{{strtolower($categoria->name)}}" @if($categoria->name == "Menú") class="menu" @else class="almuerzo" @endif>
                <div class="container">
                    <div class="section-title">
                        <h2>Nuestro <span>{{$categoria->name}}</span></h2>
                        <p style="font-weight:bold; font-style: italic;">*Las consumiciones en terraza tienen un coste
                            adicional al de la carta</p>
                    </div>
                    @if($tipos)
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-center">
                                <ul @if($categoria->name == "Menú") id="menu-flters" @else id="almuerzo-flters" @endif>
                                    <li data-filter="*" class="filter-active">Todo</li>
                                    @foreach ($tipos as $tipo)
                                        @if ($tipo->categoria_id == $categoria->id)
                                            <li data-filter=".filter-{{ strtolower($tipo->name) }}">{{ $tipo->name }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if ($platos)
                        <div @if($categoria->name == "Menú") class="row menu-container" @else class="row almuerzo-container" @endif>
                            @foreach($tipos as $tipo)
                                @if ($tipo->categoria_id == $categoria->id)
                                    <div @if($categoria->name == "Menú") class="col-lg-4 menu-item filter-{{strtolower($tipo->name)}} my-2" @else class="col-lg-4 almuerzo-item filter-{{strtolower($tipo->name)}} my-2" @endif style="flex: 0 0 33%">
                                        <h2 style="text-align: center;">{{$tipo->name}}</h2>
                                @endif
                                @foreach($platos as $plato)
                                    @if($plato->type_id == $tipo->id && $plato->category_id == $categoria->id)
                                        <div @if($categoria->name == "Menú") class="menu-content" @else class="almuerzo-content" @endif>
                                            <a href="javascript:void(0)" onclick="openModal({{ $plato->id }})">{{ $plato->name }}</a>
                                            <span>{{ $plato->price }}€</span>

                                            <!-- Modal -->
                                            <div id="imageModal{{ $plato->id }}" class="modal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $plato->id }}" hidden>
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="imageModalLabel{{ $plato->id }}">{{ $plato->name }} Image</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal({{ $plato->id }})">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img id="modalImage{{ $plato->id }}" src="{{asset('images/'.$plato->image)}}" alt="{{ $plato->name }} Image" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                function openModal(id) {
                                                    var modal = document.getElementById('imageModal' + id);
                                                    modal.style.display = 'block';
                                                    modal.hidden= false;
                                                }

                                                function closeModal(id) {
                                                    var modal = document.getElementById('imageModal' + id);
                                                    modal.style.display = 'none';
                                                    modal.hidden = true;
                                                }
                                            </script>
                                        </div>
                                        <div @if($categoria->name == "Menú") class="menu-ingredients" @else class="almuerzo-ingredients" @endif>
                                            @if($plato->ingredients)
                                                <p style="color:#948c81;">
                                                    {{$plato->ingredients}}
                                                </p>
                                            @else
                                                <br>
                                            @endif
                                            @foreach($plato->alergenos as $alergeno)
                                                <img src="{{asset('images/' . $alergeno->image)}}"
                                                     alt="Imagen alergeno" class="alergenos">
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                                    </div>
                            @endforeach
                        </div>
                </div>
                @endif
            </section>
        @endforeach
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
            <img src="{{asset('images/logo-largo.jpg')}}" class="img-fluid p-2 pt-0" style="max-width: 50%;">
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

    <script type="module" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script type="module" src="{{asset('js/glightbox.min.js')}}"></script>
    <script type="module" src="{{asset('js/isotope.pkgd.min.js')}}"></script>
    <script type="module" src="{{asset('js/swiper-bundle.min.js')}}"></script>
    <script type="module" src="{{ asset('js/validate.js') }}"></script>
    <script type="module" src="{{asset('js/app.js')}}"></script>
    <script>
        window.onload = function() {
            var mobileNavToggle = document.querySelector('.mobile-nav-toggle');
            var navbar = document.querySelector('#navbar');

            mobileNavToggle.addEventListener('click', function(e) {
                navbar.classList.toggle('navbar-mobile');
                this.classList.toggle('bi-list');
                this.classList.toggle('bi-x');
            });
        };
    </script>
    </body>
@endif
</html>
