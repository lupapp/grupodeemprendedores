<?php session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con = new Conexion();
$user=new User($con);
if(isset($_POST['submit'])) {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
    $pais = isset($_POST['pais']) ? $_POST['pais'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $repass = isset($_POST['repass']) ? $_POST['repass'] : '';

    if (empty($nombre) or empty($mail) or empty($usuario) or empty($pass)) {
        $param = [
            'ms' => 'Llene todos los campos con asterísco (obligatorio)',
            'clase' => 'alert-danger',
            'alert' => 'Error'
        ];
    } else {
        if(strcmp($pass, $repass)===0) {
            $user->setPass($pass);
            $user->setUser($usuario);
            $user->setNombre($nombre);
            $user->setMail($mail);
            $user->setCelular($celular);
            $user->setTelefono($telefono);
            $user->setDireccion($direccion);
            $user->setCiudad($ciudad);
            $user->setPais($pais);
            $user->setTipo(2);
            $resul = $user->save();
            $u=$user->getUltimoRegistro();
            $_SESSION['user']=$u;
            $param = [
                'ms' => 'Usuario creado exitosamente',
                'clase' => 'alert-success',
                'alert' => 'Exito'
            ];
            header('Location:index.php');
        }else{
            $param = [
                'ms' => 'Las contraseñas no son iguales',
                'clase' => 'alert-danger',
                'alert' => 'Error'
            ];
        }

    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro | Grupo de Emprendedores</title>
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
<!--<link type="text/css" data-themecolor="default" rel='stylesheet' href="css/main-default.css">-->

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
      <h1 class="f-primary-l c-default">Registrarme</h1>
    </div>
  </div>
</div>
<div class="l-main-container">
    <div class="b-breadcrumbs f-breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="#"><i class="fa fa-home"></i>inicio</a></li>
                <li><i class="fa fa-angle-right"></i><span> Registro</span></li>
            </ul>
        </div>
    </div>
    <div class="container b-container-login-page">
        <div class="row">
            <div class="col-md-6">
                <div class="b-form-row f-primary-l f-title-big c-secondary">Crear una cuenta</div>
                <div class="b-form-row">Consectetur adipiscing elituis sagittis eu mi et pellentesqueur</div>
                <?php
                if (!isset($param)){}else{?>

                    <div class="alert <?php echo $param['clase'] ?>">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong><?php echo $param['alert'].":"; ?></strong> <?php echo $param['ms'] ?>
                    </div>
                <?php } ?>
                <hr class="b-hr" />
                <div class="row b-form-inline b-form-horizontal">
                    <div class="col-xs-12">
                        <form action="GE-registro.php" method="post">
                            <div class="b-form-row">
                                <label class="b-form-horizontal__label" for="create_account_name">Usuario *</label>
                                <div class="b-form-horizontal__input">
                                    <input type="text" id="create_account_name" required class="form-control" name="usuario" placeholder="Escriba un usuario" />
                                </div>
                            </div>
                            <div class="b-form-row">
                                <label class="b-form-horizontal__label" for="create_account_name">Nombre *</label>
                                <div class="b-form-horizontal__input">
                                    <input type="text" id="create_account_name" required class="form-control" name="nombre" placeholder="Escriba su nombre completo" />
                                </div>
                            </div>
                            <div class="b-form-row">
                                <label class="b-form-horizontal__label" for="create_account_email">Mi Email *</label>
                                <div class="b-form-horizontal__input">
                                    <input type="mail" id="create_account_email" required class="form-control" name="mail"  placeholder="Escriba un correo electronico valido"/>
                                </div>
                            </div>

                            <div class="b-form-row">
                                <label class="b-form-horizontal__label" for="create_account_phone">Número Telefonico</label>
                                <div class="b-form-horizontal__input">
                                    <input type="text" id="create_account_phone"  class="form-control" name="telefono"  placeholder="Escriba su número telefonico"/>
                                </div>
                            </div>
                            <div class="b-form-row">
                                <label class="b-form-horizontal__label" for="create_account_phone">Número Celular</label>
                                <div class="b-form-horizontal__input">
                                    <input type="text" id="create_account_phone"  class="form-control" name="celular"  placeholder="Escriba su número celular"/>
                                </div>
                            </div>
                            <div class="b-form-row">
                                <label class="b-form-horizontal__label" for="create_account_location">Dirección</label>
                                <div class="b-form-horizontal__input">
                                    <input type="text" name="direccion" id="create_account_location" class="form-control" placeholder="Escriba su dirección"/>
                                </div>
                            </div>

                            <div class="b-form-row">
                                <label class="b-form-horizontal__label" for="create_account_password">Crear Contraseña *</label>
                                <div class="b-form-horizontal__input">
                                    <input type="password" name="pass" id="create_account_password" class="form-control"  placeholder="Escriba su contraseña" />
                                </div>
                            </div>
                            <div class="b-form-row">
                                <label class="b-form-horizontal__label" for="create_account_confirm">Confirmar Contraseña *</label>
                                <div class="b-form-horizontal__input">
                                    <input type="password" name="repass" id="create_account_confirm"class="form-control"  placeholder="Vuelva a escribir la contraseña"/>
                                </div>
                            </div>
                            <div class="b-form-row">
                                <label class="b-form-horizontal__label" for="create_account_confirm">Ciudad</label>
                                <div class="b-form-horizontal__input">
                                    <input type="text" name="ciudad" id="create_account_confirm"  class="form-control"  placeholder="Ciudad"/>
                                </div>
                            </div>
                            <div class="b-form-row">
                                <label class="b-form-horizontal__label" for="create_account_confirm">Pais</label>
                                <div class="b-form-horizontal__input">
                                    <input type="text" name="pais" id="create_account_confirm" class="form-control"  placeholder="País"/>
                                </div>
                            </div>
                            <div class="b-form-row">
                                <div class="b-form-horizontal__label"></div>
                                <div class="b-form-horizontal__input">
                                    <button name="submit" class="btn b-btn f-btn b-btn-md b-btn-default f-primary-b b-btn__w100" >Registrase</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="f-primary-l f-title-big c-secondary"><strong>Bienvenido a Grupo de Emprendedores!!</strong></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sagittis eu mi et pellentesque. Curabitur vestibulum convallis orci, quis dapibus elit fringilla eget. Suspendisse posuere diam ut erat convallis, non dictum quam luctus. </p>
                <div class="b-shortcode-example">
                    <ul class="b-list-markers f-list-markers">
                        <li><i class="fa fa-check-circle b-list-markers__ico f-list-markers__ico"></i> <a href="#">¿Para que Registrarme?</a></li>
                        <li><i class="fa fa-check-circle b-list-markers__ico f-list-markers__ico"></i> <a href="#">¿Que beneficios tengo al registrarme?</a></li>
                        <li><i class="fa fa-check-circle b-list-markers__ico f-list-markers__ico"></i> <a href="#">Leer el acuerdo de Confidencialidad</a></li>
                        <li><i class="fa fa-check-circle b-list-markers__ico f-list-markers__ico"></i> <a href="#">Proin egestas nibh luctus dui cursus, sit amet vestibulum massa dignissim.</a></li>
                        <li><i class="fa fa-check-circle b-list-markers__ico f-list-markers__ico"></i> <a href="#">Etiam facilisis sapien ut ornare euismod.</a></li>
                    </ul>
                </div>
                <div class="b-logo-partner-box">
                    <div class="b-logo-item"><a href="#">
                        <img class="is-normal" src="img/slider/partner/client-logo-5.png" alt=""/>
                        <img class="is-hover" src="img/slider/partner/client-logo-5h.png" alt=""/>
                    </a></div>
                    <div class="b-logo-item"><a href="#">
                        <img class="is-normal" src="img/slider/partner/client-logo-4.png" alt=""/>
                        <img class="is-hover" src="img/slider/partner/client-logo-4h.png" alt=""/>
                    </a></div>
                    <div class="b-logo-item"><a href="#">
                        <img class="is-normal" src="img/slider/partner/client-logo-1.png" alt=""/>
                        <img class="is-hover" src="img/slider/partner/client-logo-1h.png" alt=""/>
                    </a></div>
                    <div class="b-logo-item"><a href="#">
                        <img class="is-normal" src="img/slider/partner/client-logo-2.png" alt=""/>
                        <img class="is-hover" src="img/slider/partner/client-logo-2h.png" alt=""/>
                    </a></div>
                </div>
            </div>
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
<?php include 'footer.php'; ?>
</body>
</html>