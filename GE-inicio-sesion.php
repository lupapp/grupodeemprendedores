<?php session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con = new Conexion();?>
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
<body style="height:100%;width:100%;padding: 0;margin: 0; font-size: 48px; background: #6a9fb5; color:#ffac00; align:center; vertical-align: middle;">
<?php if(isset($_POST['submit'])){
    echo '<center style="padding: 250px 0"><i class="fas fa-spinner fa-spin" ></i> Creando Cuenta</center>';
    $pass= isset($_POST['pass']) ? $_POST['pass'] : '';
    $user= isset($_POST['user']) ? $_POST['user'] : '';
    if (empty($pass) or empty($user)) {
        $param = [
            'ms' => 'Usuario no existe o contraseña incorrecta',
            'clase' => 'alert-danger',
            'alert' => 'Error'
        ];
        //header('Location: GE-shop_cart.php?param='.serialize($param));

        $login = new Login(new Conexion());
        $login->setPass($pass);
        $login->setUser($user);
        $login->setMail($user);
        $resul = $login->signIn();
        if ($resul['existe'] == 1) {
            $_SESSION['user'] = $resul['user'];
            $param = [
                'ms' => 'Ingreso correctamente',
                'clase' => 'alert-success',
                'alert' => 'Exito'
            ];
            header('Location: GE-shop_cart.php?param=' . serialize($param));
        } else {
            $param = [
                'ms' => 'Usuario no existe o contraseña incorrecta',
                'clase' => 'alert-danger',
                'alert' => 'Error'
            ];
            header('Location: GE-shop_cart.php?param=' . serialize($param));
        }
    }
}

?>
</body>
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
<?php include 'footer.php' ?>
</html>
