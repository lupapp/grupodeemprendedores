<?php $mipagina = "cuenta"; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mi Cuenta | Grupo de Emprendedores</title>
    <link rel="shortcut icon" href="favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!-- bxslider -->
<link type="text/css" rel='stylesheet' href="js/bxslider/jquery.bxslider.css">
<!-- End bxslider -->
<!-- flexslider -->
<link type="text/css" rel='stylesheet' href="js/flexslider/flexslider.css">
<!-- End flexslider -->

<!-- bxslider -->
<link type="text/css" rel='stylesheet' href="js/radial-progress/style.css">
<!-- End bxslider -->

<!-- Animate css -->
<link type="text/css" rel='stylesheet' href="css/animate.css">
<!-- End Animate css -->

<!-- Bootstrap css -->
<link type="text/css" rel='stylesheet' href="css/bootstrap.min.css">
<link type="text/css" rel='stylesheet' href="js/bootstrap-progressbar/bootstrap-progressbar-3.2.0.min.css">
<!-- End Bootstrap css -->

<!-- Jquery UI css -->
<link type="text/css" rel='stylesheet' href="js/jqueryui/jquery-ui.css">
<link type="text/css" rel='stylesheet' href="js/jqueryui/jquery-ui.structure.css">
<!-- End Jquery UI css -->

<!-- Fancybox -->
<link type="text/css" rel='stylesheet' href="js/fancybox/jquery.fancybox.css">
<!-- End Fancybox -->

<link type="text/css" rel='stylesheet' href="fonts/fonts.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

<link type="text/css" data-themecolor="default" rel='stylesheet' href="css/main-default.css">

<link type="text/css" rel='stylesheet' href="js/rs-plugin/css/settings.css">
<link type="text/css" rel='stylesheet' href="js/rs-plugin/css/settings-custom.css">
<link type="text/css" rel='stylesheet' href="js/rs-plugin/videojs/video-js.css">
</head>
<body>
<div class="mask-l" style="background-color: #fff; width: 100%; height: 100%; position: fixed; top: 0; left:0; z-index: 9999999;"></div> <!--removed by integration-->
<?php include("GE-cabezote.php"); ?>

<div class="j-menu-container"></div>

<div class="b-inner-page-header f-inner-page-header b-bg-header-inner-page">
  <div class="b-inner-page-header__content">
    <div class="container">
      <h1 class="f-primary-l c-default">Mi Cuenta</h1>
    </div>
  </div>
</div>

<div class="l-main-container">
<div class="b-breadcrumbs f-breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="#"><i class="fa fa-home"></i>Inicio</a></li>
            <li><i class="fa fa-angle-right"></i><span>Mi cuenta</span></li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="l-inner-page-container">
        <div class="f-primary-b b-title-b-hr f-title-b-hr">Bienvenido <strong>Jon Doe</strong> a tu cuenta</div>
        
      <div class="b-shortcode-example">
            <div class="b-tabs-vertical f-tabs-vertical j-tabs-vertical b-tabs-reset row b-tabs-vertical--secondary">
                <div class="col-md-3 col-sm-4 b-tabs-vertical__nav">
                    <ul>
                        <li><a class="f-primary-l" href="#tabs-11"><i class="fa fa-suitcase"></i> Datos personales</a></li>
                        <li><a class="f-primary-l" href="#tabs-12"><i class="fa fa-flask"></i> Actualizar mis Datos</a></li>
                        <li><a class="f-primary-l" href="#tabs-13"><i class="fa fa-flag"></i>  Mis pagos</a></li>
                        <li><a class="f-primary-l" href="#tabs-14"><i class="fa fa-users"></i> Mi Historial</a></li>
                    </ul>
                </div>
                <div class="col-md-9 col-sm-8 b-tabs-vertical__content">
                    <div id="tabs-11">
                        <div class="b-tabs-vertical__content-text">
                            <h3 class="f-tabs-vertical__title f-primary-b">Datos Personales</h3>
                            <h5>Usuario: <strong>Jhon Doe</strong></h5>
                            <h5>Mi Email: <strong>jhondoe@hotmail.com</strong></h5>
                            <h5>Número Telefonico: <strong>123 456 7890</strong></h5>
                            <h5>Dirección: <strong>Cra 1 # 1-11</strong></h5>
                            <h5>Contraseña: <strong>pepitoperes</strong></h5>
                            
                        </div>
                    </div>
                    <div id="tabs-12">
                        <div class="b-tabs-vertical__content-text">
                            <h3 class="f-tabs-vertical__title f-primary-b">Modificar Datos</h3>
                            <p>Quisque at tortor a libero posuere laoreet vitae sed arcu.  </p>
                            
                          <div class="">
                                <div class="b-form-row">
                                    <label class="b-form-horizontal__label" for="create_account_name">Usuario *</label>
                                    <div class="b-form-horizontal__input">
                                        <input type="text" id="create_account_name" required class="form-control" />
                                    </div>
                                </div>
                                <div class="b-form-row">
                                    <label class="b-form-horizontal__label" for="create_account_email">Mi Email *</label>
                                    <div class="b-form-horizontal__input">
                                        <input type="text" id="create_account_email" required class="form-control" />
                                    </div>
                                </div>
                                
                                <div class="b-form-row">
                                    <label class="b-form-horizontal__label" for="create_account_phone">Número Telefonico *</label>
                                    <div class="b-form-horizontal__input">
                                        <input type="text" id="create_account_phone" required class="form-control" />
                                    </div>
                                </div>
                                <div class="b-form-row">
                                    <label class="b-form-horizontal__label" for="create_account_location">Dirección</label>
                                    <div class="b-form-horizontal__input">
                                        <input type="text" id="create_account_location" class="form-control" placeholder="Pais, Ciudad, Dirección" />
                                    </div>
                                </div>
                                
                                <div class="b-form-row">
                                    <label class="b-form-horizontal__label" for="create_account_password">crear Contraseña *</label>
                                    <div class="b-form-horizontal__input">
                                        <input type="text" id="create_account_password" required class="form-control" />
                                    </div>
                                </div>
                                <div class="b-form-row">
                                    <label class="b-form-horizontal__label" for="create_account_confirm">Confirmar Contraseña *</label>
                                    <div class="b-form-horizontal__input">
                                        <input type="text" id="create_account_confirm" required class="form-control" />
                                    </div>
                                </div>
                                <div class="b-form-row">
                                    <div class="b-form-horizontal__label"></div>
                                    <div class="b-form-horizontal__input">
                                        <label for="create_account_terms">
                                            <input type="checkbox" class="b-form-checkbox required b-form-checkbox" id="create_account_terms" />
                                            <span>Estoy de acuerdo con los  <a href="#" class="c-secondary f-more">Términos de uso</a></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="b-form-row">
                                    <div class="b-form-horizontal__label"></div>
                                    <div class="b-form-horizontal__input">
                                        <a href="#" class="b-btn f-btn b-btn-md b-btn-default f-primary-b b-btn__w100">Regístrate ahora
        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-13">
                        <div class="b-tabs-vertical__content-text">
                            <h3 class="f-tabs-vertical__title f-primary-b">Mis Pagos </h3>
                            <div class="b-shortcode-example">
                                <table class="b-table-primary f-table-primary f-center">
                                  <tr>
                                    <th>Membresia</th>
                                    <th>Fecha de Pago</th>
                                    <th>Valor Mes</th>
                                    <th> Estado de pago</th>
                                  </tr>
                                  <tr>
                                    <td>Basica</td>
                                    <td>20 febrero de 2018</td>
                                    <td>$20.000</td>
                                    <td>Confirmado</td>
                                  </tr>
                                  <tr>
                                    <td>Basica</td>
                                    <td>20 Marzo de 2018</td>
                                    <td>$20.000</td>
                                    <td>Por Confirmar</td>
                                  </tr>
                                  <tr>
                                    <td>Basica</td>
                                    <td>20 Abril de 2018</td>
                                    <td>$20.000</td>
                                    <td>En espera de pago</td>
                                  </tr>
                                  <tr>
                                    <td>Basica</td>
                                    <td>20 Mayo de 2018</td>
                                    <td>$20.000</td>
                                    <td>En espera de pago</td>
                                  </tr>
                                 
                                </table>
                          </div>
                        </div>
                    </div>
                    <div id="tabs-14">
                        <div class="b-tabs-vertical__content-text">
                            <h3 class="f-tabs-vertical__title f-primary-b">Historial de Servicios</h3>
                            <div class="b-shortcode-example">
                                <table class="b-table-primary f-table-primary f-center">
                                  <tr>
                                    <th>Categoria</th>
                                    <th>Servicio</th>
                                    <th>Valor </th>
                                    <th> Estado</th>
                                  </tr>
                                  <tr>
                                    <td>Taller</td>
                                    <td>Mente, Vida y Equilibrio Financiero</td>
                                    <td>$20.000</td>
                                    <td>Terminado</td>
                                  </tr>
                                  <tr>
                                    <td>Conferencia</td>
                                    <td>Despierta y Avanza</td>
                                    <td>$20.000</td>
                                    <td>en proceso</td>
                                  </tr>
                                  <tr>
                                    <td>Taller</td>
                                    <td>Ventas con Proposito Ver. 2.0</td>
                                    <td>$20.000</td>
                                    <td>terminado</td>
                                  </tr>
                                  <tr>
                                    <td>Consultoría</td>
                                    <td>El Poder creador Esta Dentro De Ti</td>
                                    <td>$20.000</td>
                                    <td>en proceso</td>
                                  </tr>
                                 
                                </table>
                          </div>
                        </div>
                    </div>                    
                  
                </div>
            </div>
        </div>
        <hr class="b-hr-light"/>
      
        
    </div>
</div>


</div>

	<?php include("GE-pie.php"); ?>
    
<script src="js/breakpoints.js"></script>
<script src="js/jquery/jquery-1.11.1.min.js"></script>
<!-- bootstrap -->
<script src="js/scrollspy.js"></script>
<script src="js/bootstrap-progressbar/bootstrap-progressbar.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- end bootstrap -->
<script src="js/masonry.pkgd.min.js"></script>
<script src='js/imagesloaded.pkgd.min.js'></script>
<!-- bxslider -->
<script src="js/bxslider/jquery.bxslider.min.js"></script>
<!-- end bxslider -->
<!-- flexslider -->
<script src="js/flexslider/jquery.flexslider.js"></script>
<!-- end flexslider -->
<!-- smooth-scroll -->
<script src="js/smooth-scroll/SmoothScroll.js"></script>
<!-- end smooth-scroll -->
<!-- carousel -->
<script src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
<!-- end carousel -->
<script src="js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script src="js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="js/rs-plugin/videojs/video.js"></script>

<!-- jquery ui -->
<script src="js/jqueryui/jquery-ui.js"></script>
<!-- end jquery ui -->
<script type="text/javascript" language="javascript"
        src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCfVS1-Dv9bQNOIXsQhTSvj7jaDX7Oocvs"></script>
<!-- Modules -->
<script src="js/modules/sliders.js"></script>
<script src="js/modules/ui.js"></script>
<script src="js/modules/retina.js"></script>
<script src="js/modules/animate-numbers.js"></script>
<script src="js/modules/parallax-effect.js"></script>
<script src="js/modules/settings.js"></script>
<script src="js/modules/maps-google.js"></script>
<script src="js/modules/color-themes.js"></script>
<!-- End Modules -->

<!-- Audio player -->
<script type="text/javascript" src="js/audioplayer/js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/audioplayer/js/jplayer.playlist.min.js"></script>
<script src="js/audioplayer.js"></script>
<!-- end Audio player -->

<!-- radial Progress -->
<script src="js/radial-progress/jquery.easing.1.3.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/d3/3.4.13/d3.min.js"></script>
<script src="js/radial-progress/radialProgress.js"></script>
<script src="js/progressbars.js"></script>
<!-- end Progress -->

<!-- Google services -->
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
<script src="js/google-chart.js"></script>
<!-- end Google services -->
<script src="js/j.placeholder.js"></script>

<!-- Fancybox -->
<script src="js/fancybox/jquery.fancybox.pack.js"></script>
<script src="js/fancybox/jquery.mousewheel.pack.js"></script>
<script src="js/fancybox/jquery.fancybox.custom.js"></script>
<!-- End Fancybox -->
<script src="js/user.js"></script>
<script src="js/timeline.js"></script>
<script src="js/fontawesome-markers.js"></script>
<script src="js/markerwithlabel.js"></script>
<script src="js/cookie.js"></script>
<script src="js/loader.js"></script>
<script src="js/scrollIt/scrollIt.min.js"></script>
<script src="js/modules/navigation-slide.js"></script>


</body>
</html>
