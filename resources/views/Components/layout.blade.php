<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" type="image/png" href="{{asset('assets/images/logoest.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    {{-- <link rel="icon" type="image/png" href="chemin/vers/votre-icone.png"> <!-- remplacer par votre propre icône --> --}}

    <title>{{ $title }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-space-dynamic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Contact.css') }}">

    <style>
        .lower {
            text-transform: lowercase;
        }

        .home-img {
            margin-left: 5rem;
            width: 60%;
        }

        .height-div {
            height: 15rem;
        }
      </style>
    <!--

    TemplateMo 562 Space Dynamic

    https://templatemo.com/tm-562-space-dynamic

    -->
</head>
<body>


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="#" class="logo">
                        <h4>ESTO-<span>E<span class="lower">du</span>T<span class="lower">ech</span></span></h4>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section">
                            <x-nav-link routeName="home" buttonName="top" class="active">Accueil</x-nav-link>
                        </li>
                        <li class="scroll-to-section">
                            <x-nav-link routeName="about" buttonName="about">Services</x-nav-link>
                        </li>
                        <li class="scroll-to-section">
                            <x-nav-link routeName="service" buttonName="services">À Propos de Nous</x-nav-link>
                        </li>
                        <li class="scroll-to-section">
                            <x-nav-link routeName="membres" buttonName="portfolio">Équipe</x-nav-link>
                        </li>
                        <li class="scroll-to-section">
                            <x-nav-link routeName="blog" buttonName="blog">Nouveautés</x-nav-link>
                        </li>
                        <li class="scroll-to-section">
                            <x-nav-link routeName="contact" buttonName="contact">Contactez-Nous</x-nav-link>
                        </li>
                        <li class="scroll-to-section">
                            <div class="main-red-button">
                                <x-nav-link routeName="login" buttonName="login" :login="true">Se Connecter</x-nav-link>
                            </div>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
                
            </div>
        </div>
    </div>
    
</header>
<!-- ***** Header Area End ***** -->


{{ $slot }}


<!-- ***** Footer Area Start ***** -->

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.25s">
                <p>© Copyright 2024 ESTO. All Rights Reserved.
                {{-- <br/>Designed by: BERHILI Ayoub,EL OURIACHI Abderahim,BENALI Wissal,OUZARF Aya,MARGHICH Fatima Zahra</p> --}}
            </div>
        </div>
    </div>
</footer>

</body>
</html>
