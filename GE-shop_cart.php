<?php session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con=new Conexion();
$options=new Options($con);
$dolar=$options->getByName('valor_dolar');?>
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
<?php include("GE-cabezoteCart.php"); ?>

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
                                    <tbody class="itemsCart">
                                        <tr>
                                            <th><span class="f-primary-b">Producto</span></th>
                                            <th width="130"><span class="f-primary-b">Precio</span></th>
                                            <th width="100"><span class="f-primary-b">Cantidad</span></th>
                                            <th width="170"><span class="f-primary-b">Total</span></th>
                                            <th width="70"><span class="f-center"><a class="btn-close-o" href=""><i class="fa fa-times"></i></a></span></th>
                                        </tr>

                                        <?php
                                        if(isset($_SESSION['carrito'])) {
                                            $datos = $_SESSION['carrito'];
                                            foreach ($datos as $d) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="b-href-with-img">
                                                            <a class="c-primary" href="shop_detail.html">
                                                                <img data-retina="" style="width:8%"
                                                                     src="Administer/public/img/<?php echo $d['img'] ?>"
                                                                     alt="">
                                                                <p>
                                                                    <span class="f-title-small "><?php echo $d['nombre'] ?> </span>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td><span class="f-primary-b c-default f-title-medium">$<span
                                                                    class="j-product-price"><?php echo $d['price'] ?></span></span>
                                                    </td>
                                                    <td class="f-center">
                                                        <div class="b-product-card__info_count ">
                                                            <input type="number" min="1"
                                                                   class="form-control form-control--secondary j-product-count cantid"
                                                                   name="cant" value="<?php echo $d['cant'] ?>"
                                                                   data-id="<?php echo $d['id'] ?>"/>
                                                        </div>
                                                    </td>
                                                    <td><span class="f-primary-b c-default f-title-medium">$<span
                                                                    class="j-product-total "><?php echo $d['total']  ?></span></span>
                                                    </td>
                                                    <td><span class="f-center"><a class="btn-close-o quitar"
                                                                                  data-id="<?php echo $d['id'] ?>"><i
                                                                        class="fa fa-times"></i></a></span></td>
                                                </tr>
                                            <?php }
                                        }else{ ?>
                                            <tr><td colspan="5" align='center'>No hay productos en el carro de compras</td></tr>
                                        <?php }?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                       <div class="row b-col-default-indent">
                            <div class="col-md-6 ">
                                <?php if(isset($_SESSION['user'])){ ?>
                                    <form action="paypal/comprar.php" method="post">
                                        <div class="f-primary-b b-title-b-hr f-title-b-hr b-null-top-indent">Forma de pago</div>
                                        <div class="b-shortcode-example">
                                            <div class="checkbox">
                                                <label><input type="radio" name="metodoPago" checked value="paypal"> <strong>PayPal</strong></label>
                                                <p>Pago con tarjeta de credito.</p>
                                                <?php echo round(1.9303, 5); ?>
                                                <input type="hidden" name="precio" value="<?php echo $_SESSION['total'] ?>">
                                                <input type="hidden" name="dolar" value="<?php echo $dolar->valor ?>">
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="radio" name="metodoPago" value="deposito"> <strong>Deposito bancario</strong></label>
                                                <p>Debe consignar en la cuenta que bancaria que le llegará al correo electrónico junto con el pedido despues de hacer el deposito envia al correo info@gmail.com la copia del recibo.</p>
                                            </div>
                                        </div>
                                        <button href="GE-procesar-pedido.php" name="submit" class="b-btn f-btn b-btn-lg f-btn-lg b-btn-default f-primary-b button-gray pull-right">Completar compra <i class="fas fa-arrow-right"></i></button>
                                    </form>
                                <?php }else{ ?>
                                <div class="b-product-cart-small">
                                    <div class="b-product-cart-small__header">
                                        <div class="f-primary-b c-default f-uppercase b-title-b-hr f-title-b-hr">DATOS DEL USUARIO
                                        </div>
                                    </div>
                                    <div class="b-tabs f-tabs j-tabs b-tabs-reset b-tabs--secondary f-tabs--secondary">
                                        <ul class="f-left">
                                            <li><a href="#tabs-31">Iniciar Sesión</a></li>
                                            <li><a href="#tabs-32">Registrarse</a></li>
                                        </ul>
                                        <div class="b-tabs__content">
                                            <?php

                                            if (!isset($_GET['param'])){}else{
                                                $param=unserialize($_GET['param']);?>

                                                <div class="alert <?php echo $param['clase'] ?>">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    <strong><?php echo $param['alert'].":"; ?></strong> <?php echo $param['ms'] ?>
                                                </div>
                                            <?php } ?>
                                        <div id="tabs-31" class="clearfix">
                                            <div class="b-form-row b-form-inline b-form-horizontal">
                                                <div class="f-primary-l f-title-big c-secondary">Identifícate</div>
                                                <form action="GE-inicio-sesion.php" method="post">
                                                    <div class="col-xs-12">
                                                        <div class="b-form-row">
                                                            <label class="b-form-horizontal__label" for="create_account_email">Tu Email o Usuario</label>
                                                            <div class="b-form-horizontal__input">
                                                                <input type="text" name="user" id="create_account_email" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="b-form-row">
                                                            <label class="b-form-horizontal__label" for="create_account_password">Tu Contraseña</label>
                                                            <div class="b-form-horizontal__input">
                                                                <input type="text" name="pass" id="create_account_password" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <!--<div class="b-form-row">
                                                            <div class="b-form-horizontal__label"></div>
                                                            <label for="contact_form_copy" class="b-contact-form__window-form-row-label">
                                                                <input type="checkbox" id="contact_form_copy" class="b-form-checkbox" />
                                                                <span>Recordarme</span>
                                                            </label>
                                                        </div>-->
                                                        <div class="b-form-row">
                                                            <div class="b-form-horizontal__label"></div>
                                                            <div class="b-form-horizontal__input">
                                                                <input type="submit" name="submit" class="btn b-btn f-btn b-btn-md b-btn-default f-primary-b b-btn__w100" value="Iniciar Sesión">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="tabs-32" class="clearfix">
                                            <div class="b-form-row f-primary-l f-title-big c-secondary">Crear una cuenta</div>

                                            <hr class="b-hr" />
                                            <div class="row b-form-inline b-form-horizontal">
                                                <div class="col-xs-12">
                                                    <form action="GE-crear-cuenta.php" method="post">
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

                                    </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                            <div class="col-md-6">
                                <div class="f-primary-b c-default f-uppercase b-title-b-hr f-title-b-hr">total a pagar
                                    <span class="j-price-total pull-right totalCart">$ <?php if(isset($_SESSION['carrito'])){echo $_SESSION['total']; }?></span>
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