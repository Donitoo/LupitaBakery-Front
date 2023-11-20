<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Lupita's Bakery</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
			CSS
			============================================= -->
    <link rel="stylesheet" href="assets/css/linearicons.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/main.css">



</head>

<body>

    <header id="header" id="home">
        <div class="header-top">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
                        <ul>
                            <li>
                                Lunes a Viernes: 8am - 2pm
                            </li>
                            <li>
                                Sabados y Domingos: 11am - 4pm
                            </li>
                            <li>
                                <a href="tel:(012) 6985 236 7512">+16574395150</a>
                            </li>
                            <?php
                        if (!isset($_SESSION['email'])){
                      
                            echo "<li><a href='login.php'><b>(Iniciar sesion)</b></a></li>";
                            
                        }else{
                            
                            echo "<li><a href='panel/cerrarSesion.php'><b>(Cerrar sesion)</b></a></li>";
                        }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="#"><img src="assets/img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="#home">Inicio</a></li>
                        <li><a href="#about">Acerca de</a></li>
                        <li><a href="#coffee">Nuestros productos</a></li>
                        <?php
                        if (isset($_SESSION['email'])){
                        ?>

                        <?php
                        }
                        ?>
                    </ul>
                </nav>
                <!-- #nav-menu-container -->
            </div>
        </div>
    </header>
    <!-- #header -->


    <!-- start banner Area -->
    <section class="banner-area" id="home">
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-start">
                <div class="banner-content col-lg-7">
                    <h6 class="text-white text-uppercase"> Entrega de panes</h6>
                    <h1>
                        ¡Preparamos los panes mas deliciosos!

                    </h1>
                    <a href="login.php" class="primary-btn text-uppercase">Compra ahora</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start video-sec Area -->
    <section class="video-sec-area pb-100 pt-40" id="about">
        <div class="container">
            <div class="row justify-content-start align-items-center">
                <div class="col-lg-6 video-right justify-content-center align-items-center d-flex">

                </div>
                <div class="col-lg-6 video-left">
                    <h6>Bakery</h6>
                    <h1>Lupita's</h1>
                    <p><span>¡Preparamos los panes mas deliciosos!</span></p>
                    <p>
                    ¡Has tu pedido desde cualquier parte del país! 
                    Lupita's Bakery es el servicio de entrega de pan en línea más confiable ya que garantizamos 
                    la entrega de nuestros panes a tiempo. Cada delicioso pan pedido por correo se entrega en una
                    elegante caja de regalo con una tarjeta de felicitación adecuada a su ocasión.
                    </p>

                </div>
            </div>
        </div>
    </section>
    <!-- End video-sec Area -->

    <!-- Start menu Area -->
    <section class="menu-area section-gap" id="coffee">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-10">
                    <div class="title text-center">
                        <h1 class="mb-10">¿Que tipos de panes te ofrecemos?</h1>
                        <p>No es el aroma, ni el color, es la sinfonia del crujido</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-menu">
                        <div class="title-div justify-content-between d-flex">
                            <h4>FRENCH BAGUETTE</h4>
                            <p class="price float-right">
                                S/. 1.48
                            </p>
                        </div>
                        <p>
                            <img src="assets/img/FRENCH_BAGUETTE.jpg" alt="FRENCH BAGUETTE">
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-menu">
                        <div class="title-div justify-content-between d-flex">
                            <h4>FRENCH BRIOCHE CROISSANTS</h4>
                            <p class="price float-right">
                                S/. 4.48
                            </p>
                        </div>
                        <p>
                            <img src="assets/img/FRENCH_BRIOCHE_CROISSANTS.jpg" alt="FRENCH BRIOCHE CROISSANTS">
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-menu">
                        <div class="title-div justify-content-between d-flex">
                            <h4>CHEESE BREAD</h4>
                            <p class="price float-right">
                                S/. 4.48
                            </p>
                        </div>
                        <p>
                            <img src="assets/img/cheese-bread-loaves.jpg" alt="CHEESE BREAD">
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End menu Area -->


    <!-- start footer Area -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Sobre nosotros</h6>
                        <p>
                        ¡Has tu pedido desde cualquier parte del país! 
                        Lupita's Bakery es el servicio de entrega de pan en línea más confiable ya que garantizamos 
                        la entrega de nuestros panes a tiempo.
                        </p>
                        <p class="footer-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                            document.write(new Date().getFullYear());
                            </script> All rights reserved
                        </p>
                    </div>
                </div>
                <div class="col-lg-5  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Noticias</h6>
                        <p>Mantente actualizado de nuestros ultimos productos</p>
                        <div class="" id="mc_embed_signup">
                            <form target="_blank" novalidate="true"
                                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                method="get" class="form-inline">
                                <input class="form-control" name="EMAIL" placeholder="Enter Email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                                    required="" type="email">
                                <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right"
                                        aria-hidden="true"></i></button>
                                <div style="position: absolute; left: -5000px;">
                                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
                                        type="text">
                                </div>

                                <div class="info pt-20"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
                    <div class="single-footer-widget">
                        <h6>Siguenos</h6>
                        <p>Dinos tu opinion por nuestras redes sociales</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/easing.min.js"></script>
    <script src="assets/js/hoverIntent.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.sticky.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/parallax.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/mail-script.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="//code-eu1.jivosite.com/widget/LEp1cNjq6v" async></script>

</body>

</html>