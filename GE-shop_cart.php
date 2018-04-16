<?php session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con=new Conexion(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tu Carro |  Grupo de Emprendedores</title>
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
<body >
    <div class="mask-l" style="background-color: #fff; width: 100%; height: 100%; position: fixed; top: 0; left:0; z-index: 9999999;"></div> <!--removed by integration-->
<?php include("GE-cabezote.php"); ?>

<div class="j-menu-container"></div>

    <div class="b-inner-page-header f-inner-page-header b-bg-header-inner-page">
  <div class="b-inner-page-header__content">
    <div class="container">
      <h1 class="f-primary-l c-default">Tu Carro de Compras</h1>
      <div class="f-primary-l f-inner-page-header_title-add c-senary">así va tu carro de compras</div>
    </div>
  </div>
</div>
    <div class="l-main-container">

        <div class="b-breadcrumbs f-breadcrumbs">
            <div class="container">
                <ul>
                    <li><a href="#"><i class="fa fa-home"></i>Inicio</a></li>
                    <li><i class="fa fa-angle-right"></i><span>Carro</span></li>
                </ul>
            </div>
        </div>

        <section class="b-infoblock">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="b-shortcode-example">
                            <div class="f-primary-b b-title-b-hr f-title-b-hr b-null-top-indent">Carro de Compras</div>
                            <div class="b-product-cart b-default-top-indent b-table-reset j-price-count-box">
                                <table>
                                    <tbody>
                                        <tr>
                                            <th><span class="f-primary-b">Producto</span></th>
                                            <th width="130"><span class="f-primary-b">Precio</span></th>
                                            <th width="100"><span class="f-primary-b">Cantidad</span></th>
                                            <th width="170"><span class="f-primary-b">Total</span></th>
                                            <th width="70"><span class="f-center"><a class="btn-close-o" href=""><i class="fa fa-times"></i></a></span></th>
                                        </tr>

                                        <?php $datos=$_SESSION['carrito'];
                                        foreach ($datos as $d){?>
                                        <tr>
                                            <td>
                                                <div class="b-href-with-img">
                                                    <a class="c-primary" href="shop_detail.html">
                                                        <img data-retina="" style="width:8%" src="Administer/public/img/<?php echo $d['img'] ?>" alt="">
                                                        <p>
                                                            <span class="f-title-small "><?php echo $d['nombre'] ?> </span>
                                                        </p>
                                                    </a>
                                                </div>
                                            </td>
                                            <td><span class="f-primary-b c-default f-title-medium">$<span class="j-product-price"><?php echo $d['price'] ?></span></span></td>
                                            <td class="f-center">
                                                <div class="b-product-card__info_count">
                                                    <input type="number" min="1" class="form-control form-control--secondary j-product-count" value="<?php echo $d['cant'] ?>">
                                                </div>
                                            </td>
                                            <td><span class="f-primary-b c-default f-title-medium">$<span class="j-product-total "></span></span></td>
                                            <td><span class="f-center"><a class="btn-close-o" href=""><i class="fa fa-times"></i></a></span></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                       <!-- <div class="row b-col-default-indent">
                            <div class="col-md-6 ">
                                <div class="b-product-cart-small">
                                    <div class="b-product-cart-small__header">
                                        <div class="f-primary-b c-default f-uppercase f-title-small">CALCULAR COSTO DE ENVÍO
</div>
                                    </div>
                                    <div class="b-product-cart-small__content">
                                        <div class="b-product-cart-small__content_row">
                                            <div class="b-form-row--big b-form-select b-select--secondary">
                                                <select class="j-select">
                                                    <option>Argentina</option>
                                                    <option selected="selected">Colombia</option>
                                                    <option>Russia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="b-product-cart-small__content_row clearfix">
                                            <div class="b-product-cart-small__content_row-half">
                                                <div class="b-form-row--big b-form-select b-select--secondary">
                                                    <select class="j-select">
                                                        <option selected="selected">Ciudad</option>
                                                        <option>State 1</option>
                                                        <option>State 2</option>
                                                        <option>State 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="b-product-cart-small__content_row-half">
                                                <div class="b-form-row--big b-form-select b-select--secondary">
                                                    <select class="j-select">
                                                        <option selected="selected">Código postal </option>
                                                        <option>12345</option>
                                                        <option>23456</option>
                                                        <option>34567</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="b-btn f-btn b-btn-sm f-btn-sm b-btn-default f-primary-b">Enviar</a>
                                        </div>
                                    </div>
                                </div>

                            </div>-->
                        <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="b-product-cart-small">
                                    <div class="b-product-cart-small__header">
                                        <div class="f-primary-b c-default f-uppercase b-title-b-hr f-title-b-hr">total a pagar
                                            <span class="j-price-total pull-right">$ <?php echo $_SESSION['total'] ?></span>
                                        </div>
                                    </div>
                                    <div class="b-product-cart-small__content">
                                        <div class="b-product-cart-small__content_info">
                                            <!-- <div class="b-product-cart-small__content_info_row">
                                                <div class="b-product-cart-small__content_info_title f-title-smallest c-senary">
                                                    Subtotal
                                                </div>
                                                <div class="b-product-cart-small__content_info_value f-primary-b c-default f-title-medium">
                                                    $ <?php echo $_SESSION['total'] ?><span class="j-price-total"></span>
                                                </div>
                                            </div>-->
                                            <!--<div class="b-product-cart-small__content_info_row">
                                                <div class="b-product-cart-small__content_info_title f-title-smallest c-senary">
                                                   Gastos de envío
                                                </div>
                                                <div class="b-product-cart-small__content_info_value f-primary-b c-default f-title-medium">
                                                    0
                                                </div>
                                            </div>
                                            <div class="b-product-cart-small__content_info_row">
                                                <div class="b-product-cart-small__content_info_title f-title-smallest c-senary">
                                                    Precio total de la orden
                                                </div>
                                                <div class="b-product-cart-small__content_info_value f-primary-b c-default f-title-medium">
                                                    $ <span class="j-price-total"></span>
                                                </div>
                                            </div>-->
                                        </div>
                                        <div>
                                            <div class="b-tag-container b-right">
                                                <form action="GE-procesar-pedido.php" method="POST">
                                                    <!--<div class="f-primary-b b-title-b-hr f-title-b-hr b-null-top-indent">Ubicación</div>
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">Ciudad</span></label>
                                                         <input class="form-control" type="text" name="ciudad" placeholder="Ciudad">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">País</span></label>
                                                        <input class="form-control" type="text" name="pais" placeholder="País">
                                                    </div>-->
                                                    <div class="f-primary-b b-title-b-hr f-title-b-hr b-null-top-indent">Forma de pago</div>
                                                    <div class="b-shortcode-example">
                                                        <div class="checkbox">
                                                            <label><input type="radio" name="metodoPago" checked value="paypal"> <strong>PayPal</strong></label>
                                                            <p>Pago con tarjeta de credito.</p>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input type="radio" name="metodoPago" value="deposito"> <strong>Deposito bancario</strong></label>
                                                            <p>Debe consignar en la cuenta que bancaria que le llegará al correo electrónico junto con el pedido despues de hacer el deposito envia al correo info@gmail.com la copia del recibo.</p>
                                                        </div>
                                                    </div>

                                                    <button href="GE-procesar-pedido.php" name="submit" class="b-btn f-btn b-btn-lg f-btn-lg b-btn-default f-primary-b button-gray pull-right">Continuar <i class="fas fa-arrow-right"></i></button>
                                                </form>


                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>

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