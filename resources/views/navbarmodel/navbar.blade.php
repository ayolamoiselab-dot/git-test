<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/acceuil.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700&family=Poppins:wght@200&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
    <link rel="stylesheet" href="{{asset('css/menus.css')}}">
    <link rel="stylesheet" href="{{asset('css/inscription.css')}}">
    <link rel="stylesheet" href="{{asset('css/slides.css')}}">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- Custom CSS -->
    <!--<link rel="stylesheet" href="{{asset('css/custom.css')}}">-->


    <!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
<!-- Web App Manifest -->
<link rel="manifest" href="{{ asset('manifest.json') }}">
<!-- Apple Touch Icon -->
<link rel="apple-touch-icon" href="{{ asset('img/aemtechnology.png') }}">



    <script src="https://cdn.cinetpay.com/seamless/main.js" type="text/javascript"></script>





    <title>Acceuil.aemtechnologySchoolcenter</title>
</head>

<body>
    <div id="preloader"  style="text-align: center;">
        <img src="{{ asset('img/aemtechnology.png') }}" alt="Loading..." />
        <p style="margin-top: 20px; font-size: 16px; color: #333;">Loading...</p>
    </div>
 
    
    <header>

        <div class="container">
            <nav class="flex items-centre justify-between">
                <div class="left flex justfiy-right">
                    <!--<div class="logo"> <img src="{{asset ('img/logo.png')}}" width="50px" alt="logo"> </div>-->
                    <div>
                        @guest
                <li><a href="{{ route('login') }}">Se Connecter</a></li>
                <li><a href="{{ route('sign-in') }}">Nouveau Utilisateur</a></li>
                @else
                         <li><a href="{{url('/acceuil')}}">Home</a>
                          <a href="#about">About</a>
                           <a href="{{ route('dashboard') }}">Gestion&Dashboard</a>
                            <a href="{{ route('logoutpro') }}">Se Deconnecter</a>
                         </li>
                         <div class="user-info">
                            <p>Bienvenue, {{ Auth::user()->name ?? Auth::user()->email }}</p>
                        </div>
                         @endguest
                       
                    </div>
                </div>
                <div class="right"> <button class="btn btn-primary"><a href="#contact">Contact</a></button> </div>
            </nav>
        </div>
        
        </div>
        </div>
    </header>
    <!-- Le contenu -->
    @yield("content")

    <h7 id="contact"></h7>
    <!-- Start Contact info -->
    <section id="contact">
        <div class="contact-container container">
            <div class="contact-img">
                <img src="https://i.postimg.cc/1XvYM67V/restraunt2.jpg" alt="" />
            </div>

            <div class="form-container">
                <h2>Contact Us</h2>
                <input type="text" placeholder="Your Name" />
                <input type="email" placeholder="E-Mail" />
                <textarea cols="30" rows="6" placeholder="Type Your Message"></textarea>
                <a href="#" class="btn btn-primary">Submit</a>
            </div>
        </div>
    </section>
    <footer id="footer">
        <h2>AEMTechnology &copy; all rights reserved</h2>
    </footer>
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>



    <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            preloader.style.display = 'none';
        });
    </script>
    

</body>

</html>