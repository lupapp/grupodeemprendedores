<?php $mipagina = "servicios";
session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con=new Conexion();
$producto=new Producto($con);
$pro=$producto->getById($_GET['id']);
$imagen=new Imagen($con);
$img=$imagen->getByProd($pro->id);
$clasificacion = new Clasificacion($con);
$clas=$clasificacion->getAll();
$comentario=new Comentario($con);
$com=$comentario->getByIdProducto($pro->id);
$usuario=new User($con);
$calificacion=new Calificacion($con);
$cantidad=$calificacion->getByIdProducto($pro->id);
$promedio=$calificacion->getPromedio($pro->id);
$cat=new Categoria($con);
if(isset($_POST['enviocoment'])){
    $coment= isset($_POST['comentario']) ? $_POST['comentario'] : '';
    $fecha = date('Y') . "-" . date('m') . "-" . date('d');
    $hora = date('g') . ":" . date('i') . " " . date('A');
    if (empty($coment)){
        $param=[
            'ms'=>'Envie un comentario',
            'clase'=>'alert-danger',
            'alert'=>'Error'
        ];
    }else {
        $comentario->setComentario($coment);
        $comentario->setCliente($_SESSION['user']['id']);
        $comentario->setProducto($_GET['id']);
        $comentario->setEstado('1');
        $comentario->setFecha($fecha);
        $comentario->setHora($hora);
        $comentario->save();
        $param=[
            'ms'=>'Comentario registrado',
            'clase'=>'alert-success',
            'alert'=>'Exito'
        ];
    }
}
if(isset($_POST['submit'])){
    $pass= isset($_POST['pass']) ? $_POST['pass'] : '';
    $user= isset($_POST['user']) ? $_POST['user'] : '';
    if (empty($pass) or empty($user)){
        $param=[
            'ms'=>'Lle escriba usuario o email y la contraseña correcta',
            'clase'=>'alert-danger',
            'alert'=>'Error'
        ];
    }else {
        $login = new Login(new Conexion());
        $login->setPass($pass);
        $login->setUser($user);
        $login->setMail($user);
        $resul = $login->signIn();
        $_SESSION['user'] = $resul['user'];
        $param=[
            'ms'=>'Ingreso correctamente',
            'clase'=>'alert-success',
            'alert'=>'Exito'
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>servicios: detalle | Grupo de Emprendedores</title>
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
      <h1 class="f-primary-l c-default">Servicios</h1>
      <div class="f-primary-l f-inner-page-header_title-add c-senary">This is online store listing products sample page</div>
    </div>
  </div>
</div>
    <div class="l-main-container">

        <div class="b-breadcrumbs f-breadcrumbs">
            <div class="container">
                <ul>
                    <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
                    <li><i class="fa fa-angle-right"></i><a href="GE-portafolio_servicios.php"> Servicios</a></li>
                    <li><i class="fa fa-angle-right"></i><span> Detalle</span></li>
                </ul>
            </div>
        </div>

        <section class="b-infoblock">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <?php
                        if(!isset($ms)) {
                            $ms = $pass = isset($_GET['ms']) ? $_GET['ms'] : '';
                        }
                        if (empty($ms)){}else{?>

                            <div class="alert <?php echo $_GET['clase'] ?>">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong><?php echo $_GET['alert'].":"; ?></strong> <?php echo $ms ?>
                                <a href="clasificaciones.php" class="btn btn-primary pull-right cursor-pointer mr-1" >Finalizar</a>
                            </div>
                        <?php }?>
                        <div class="b-shortcode-example">
                            <?php $ca=$cat->getById($pro->categoria);?>
                            <div class="f-secondary-b b-title-b-hr f-title-b-hr b-null-top-indent"><i class="<?php echo $ca->img ?>"></i> <i class="b-dotted f-dotted"></i> <?php echo $ca->nombre ?></div>
                            <div class="b-product-card b-default-top-indent">
                                <div class="b-product-card__visual-wrap">
                                    <div class="flexslider b-product-card__visual flexslider-zoom">
                                        <ul class="slides">
                                            <?php foreach ($img as $im){ ?>
                                            <li>
                                                <img src="Administer/public/img/<?php echo $im->imagen ?>" />
                                            </li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                    <div class="flexslider flexslider-thumbnail b-product-card__visual-thumb carousel-sm">
                                        <ul class="slides">
                                            <?php foreach ($img as $im){ ?>
                                                <li>
                                                    <img src="Administer/public/img/<?php echo $im->imagen ?>" />
                                                </li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>
                                <div class="b-product-card__info col-md-4">
                               
                                    <h4 class="b-h4-special f-secondary-b">información</h4>
                                    <div class="b-news-item__info_title-big f-news-item__info_title-big f-primary-b"><?php echo $pro->name ?></div>
                                <div class="b-news-item__article b-color-picker b-news___color-picker f-news___color-picker f-uppercase f-h4-special ">
                                    <span class="f-news___color-picker_title ">Para:</span>
                                    <div class="b-color-picker__box">
                                        <?php foreach ($clas as $c){?>
                                        <div class="b-btn f-btn b-btn-light f-btn-light button-gray is-active clasif" data-toggle="tooltip" title="<?php echo $c->nombre ?>" data-idclasif="<?php echo $c->id ?>" data-min="<?php echo $c->min ?>" data-max="<?php echo $c->max ?>" data-por="<?php echo $c->porcentaje ?>">
                                            <i class="<?php echo $c->icono ?>"></i>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                    <div class="b-product-card__info_row valoracion">
                                        <div class="b-product-card__info_title f-primary-b f-title-smallest">Valoración</div>
                                        <div class="b-stars-group f-stars-group b-margin-right-standard">
                                        <?php for($i=1;$i<=$promedio;$i++) { ?>
                                            <i class="fa fa-star is-active-stars"></i>
                                        <?php } ?>
                                        </div>
                                        <span class="f-primary-b c-tertiary f-title-smallest"> (<?php echo count($cantidad)?> opiniones)</span>
                                    </div>
                                    <div class="b-product-card__info_row">
                                        <div class="b-product-card__info_description f-product-card__info_description">
                                            <?php echo $pro->descripcion ?>
                                        </div>
                                    </div>

                                    <?php
                                    $valor=number_format($pro->valor, 2, ',', '.');
                                    if($ca->nombre=='Membresias'){
                                        $options=new Options($con);
                                        $dolar=$options->getByName('valor_dolar');?>
                                        <form action="GE-procesar-membresia.php" method="post" class="formPago">
                                            <input type="hidden" class="des" name="des" >
                                            <input type="hidden" class="cupon" name="cupon" >
                                            <input type="hidden" class="producto" name="producto" value="<?php echo $pro->name ?>">
                                            <input type="hidden" class="img" name="img" value="<?php echo $img[0]->imagen ?>">
                                            <input type="hidden" class="idpro" name="idpro" value="<?php echo $pro->id ?>">
                                            <input type="hidden" name="dolar" value="<?php echo $dolar->valor ?>" >
                                            <input type="hidden" name="precio" value="<?php echo $pro->valor ?>">
                                            <div class="f-primary-b b-title-b-hr f-title-b-hr b-null-top-indent">Forma de pago</div>
                                            <div class="b-shortcode-example">
                                                <div class="checkbox">
                                                    <label><input type="radio"   name="metodoPago" checked value="payu">
                                                        <strong>Payu</strong></label>
                                                    <p>Pago con tarjeta de credito, transferencia bancaria.</p>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input type="radio"  name="metodoPago" value="paypal"> <strong>PayPal</strong></label>
                                                    <p>Pago con tarjeta de credito.</p>

                                                </div>
                                                <div class="checkbox">
                                                    <label><input type="radio"  name="metodoPago" value="deposito"> <strong>Deposito bancario</strong></label>
                                                    <p>Debe consignar en la cuenta que bancaria que le llegará al correo electrónico junto con el pedido despues de hacer el deposito envia al correo info@gmail.com la copia del recibo.</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="b-product-card__info_row pull-right">
                                                        <div class="b-product-card__info_title f-primary-b f-title-smallest">Valor</div>
                                                        <span class="f-product-card__info_price c-default f-primary-b">$ <span class="valor" data-valor="<?php echo $pro->valor ?>"><?php echo $valor ?></span>  </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button name="submit" class="b-btn f-btn b-btn-sm-md f-btn-sm-md btn-anadir">Completar compra <i class="fas fa-arrow-right"></i></button>

                                                </div>
                                            </div>
                                        </form>
                                    <?php }else{?>
                                    <div class="b-product-card__info_row">
                                        <div class="b-product-card__info_row">
                                            <div class="b-product-card__info_title f-primary-b f-title-smallest">Valor</div>
                                            <span class="f-product-card__info_price c-default f-primary-b">$ <span class="valor" data-valor="<?php echo $pro->valor ?>"><?php echo $valor ?></span></span>
                                        </div>
                                        <div class="b-product-card__info_count">
                                            <input type="number" min="1" class="form-control form-control--secondary cantidad" value="1">
                                        </div>
                                        <div class="b-product-card__info_add b-margin-right-standard anadir">
                                            <div class=" b-btn f-btn b-btn-sm-md f-btn-sm-md btn-anadir">
                                                <a class="addCart"  data-img="<?php echo $img[0]->imagen ?>" data-id="<?php echo $pro->id ?>" data-valor="<?php echo $pro->valor ?>" data-nombre="<?php echo $pro->name ?>" data-idclasif="0" data-modi="modi">añadir <i class="fa fa-shopping-cart"></i> </a>
                                            </div>
                                        </div>
                                        <!--<div class="b-product-card__info_like  b-btn f-btn b-btn-sm-md f-btn-sm-md b-btn--icon-only">
                                            <i class="fa fa-heart"></i>
                                        </div>-->
                                    </div>
                                    <?php } ?>

                                    <!--<div class="b-product-card__info_row">
                                        <div class="b-product-card__info_title f-primary-b f-title-smallest">Categorias</div>
                                        <a class="f-more f-title-smallest" href="">Dress</a>, <a class="f-more f-title-smallest" href="">Lorem</a>
                                    </div>
                                    <div class="b-product-card__info_row">
                                        <div class="b-product-card__info_title f-primary-b f-title-smallest">Tags</div>
                                        <div class="b-tag-container">
                                            <a class="f-tag b-tag" href="">Dress</a>
                                        </div>
                                    </div>-->
                                    <div class="b-product-card__info_row">
                                        <div class="b-btn-group-hor f-btn-group-hor">
                                            <a href="#" class="b-btn-group-hor__item f-btn-group-hor__item">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a href="#" class="b-btn-group-hor__item f-btn-group-hor__item">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="#" class="b-btn-group-hor__item f-btn-group-hor__item">
                                                <i class="fab fa-dribbble"></i>
                                            </a>
                                            <a href="#" class="b-btn-group-hor__item f-btn-group-hor__item">
                                                <i class="fab fa-behance"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                 <div class="b-action-info f-primary-b">
                                    <div class="b-action-info_text f-action-info_text">Nuevo</div>
                                </div>
                    <div class="f-secondary-b f-title-b-hr f-h4-special f-title-medium">Especificaciones</div>
                    <div class="b-information-box f-information-box f-primary-b b-information--max-size">
                        <ul>
                            <?php $esp =json_decode($pro->esp, true);
                            $con=1;
                            foreach ($esp as $e){
                            ?>
                            <li>
                                <strong class="f-information-box__name b-information-box__name f-secondary-b"><?php echo $e['especificacion']?></strong>
                                <i class="b-dotted f-dotted">:</i>
                                <span class="f-information_data"><?php echo $e['valor'] ?></span>
                            </li>
                            <?php } ?>

                        </ul>
                    </div>
                    <div class="b-overview__comment">
                    <div class="f-secondary-b f-title-b-hr f-h4-special f-title-medium">Comentario</div>
                        <?php $ultimo=$comentario->getUltimoRegistroByProducto($pro->id);
                        if(isset($ultmo)){?>
                        <div class="b-mention-short-item">
                          <div class="b-mention-short-item__comment">
                              <?php
                                  $user = $usuario->getById($ultimo->cliente);
                              ?>
                                <div class="b-mention-short-item__comment_text f-mention-short-item__comment_text c-29"><?php echo $ultimo->comentario ?> </div>
                                <div class="b-stars-group f-stars-group">
                                  <i class="fa fa-star is-active-stars"></i>
                                  <i class="fa fa-star is-active-stars"></i>
                                  <i class="fa fa-star is-active-stars"></i>
                                  <i class="fa fa-star is-active-stars"></i>
                                  <i class="fa fa-star"></i>
                                </div>
                          </div>
                          <div class="b-mention-short-item__user">

                            <div class="b-mention-short-item__user_info f-right">

                              <div class="f-mention-short-item__user_name f-primary-b"><?php echo $user->nombre ?></div>

                            </div>
                          </div>
                        </div>
                        <?php }else{ ?>

                        <?php } ?>
                    </div>
                </div>
                                
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="b-shortcode-example">
                            <div class="b-tabs f-tabs j-tabs b-tabs-reset b-tabs--secondary f-tabs--secondary">
        <ul class="f-left">
            <li><a href="#tabs-31">Detalles</a></li>
            <li><a href="#tabs-32">Calificación</a></li>
        </ul>
        <div class="b-tabs__content">
            <div id="tabs-31" class="clearfix">
                <div class="row b-daily-row">
                    <?php echo $pro->detalle ?>
                </div>
            </div>
            <div id="tabs-32" class="clearfix">
                <div class="b-comment-blog-box col-md-12" id="comment">
                    <div class="b-comments-box">

                        <div class="b-comment__title f-comment__title">
                            <span class="b-comment__title__name f-primary-b"><?php echo count($com) ?> Comentarios</span>
                            <a class="b-comment__now f-comment__now cursor-pointer abrircoment">
                                <i class="fas fa-comments"></i> Deja un comentario ahora
                            </a>
                        </div>
                        <div class="b-comment__list">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="row comen">
                                        <?php if(!isset($_SESSION['user'])){?>

                                            <form action="GE-shop_detalle.php?id=<?php echo $pro->id ?>" method="post">
                                            <div class="col-md-6">
                                                <div class="b-form-row">
                                                    <label class="b-form-horizontal__label" for="create_account_email">Tu Email o Usuario</label>
                                                    <div class="b-form-horizontal__input">
                                                        <input type="text" name="user" id="create_account_email" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="b-form-row">
                                                    <label class="b-form-horizontal__label" for="create_account_password">Tu Contraseña</label>
                                                    <div class="b-form-horizontal__input">
                                                        <input type="text" name="pass" id="create_account_password" class="form-control" />
                                                    </div>
                                                </div>

                                            </div>
                                            <a href="GE-registro.php" class="button-sm button-gray">Registrame</a>
                                            <button class="btn b-btn f-btn b-btn-md b-btn-default f-primary-b " name="submit">Iniciar Sesión</button>
                                        <?php } ?>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-9">
                                            <form action="GE-new-comentario.php" method="post" class="comen hidden">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea3 ">Comentario</label>
                                                    <textarea class="form-control textcomentario" name="comentario" id="exampleFormControlTextarea3" rows="4"></textarea>
                                                </div>
                                                <input type="hidden" name="idpro" value="<?php echo $pro->id ?>">
                                                <button class="btn btn-warning btn-sm pull-right enivarcoment" name="enviocoment">Enviar</button>
                                            </form>
                                            <ul class="itemcoments">
                                                <?php
                                                if(count($com)>0) {
                                                    foreach ($com as $cm) {
                                                        $us = $usuario->getById($cm->cliente); ?>

                                                        <li class="b-comment-item">
                                                            <div class="b-comment-item">

                                                                <div class="b-comment__descr">
                                                                    <div class="b-comment__descr__data">
                                                                        <div class="b-comment__descr__name f-comment__descr__name f-primary-b"><?php echo $us->nombre ?></div>
                                                                        <div class="b-review_title-stars pull-right">
                                                                    <span class="b-stars-group f-stars-group">
                                                                        <i class="fa fa-star is-active-stars"></i>
                                                                        <i class="fa fa-star is-active-stars"></i>
                                                                        <i class="fa fa-star is-active-stars"></i>
                                                                        <i class="fa fa-star is-active-stars"></i>
                                                                        <i class="fa fa-star is-active-stars"></i>
                                                                    </span>
                                                                        </div>

                                                                    </div>
                                                                    <div class="f-comment__descr__txt">
                                                                        <p><?php echo $cm->comentario ?></p>
                                                                    </div>
                                                                    <div class="b-comment__descr__data">
                                                                        <div class="b-comment__descr__info f-comment__descr__info">
                                                                            <span class="f-comment__date"><?php echo $cm->fecha ?></span>
                                                                            <i class="b-comment__infp__slash">/</i> <?php echo $cm->hora ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php }
                                                }?>
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <?php if(isset($_SESSION['user'])){
                                                $valida=$calificacion->verificar($_GET['id'],$_SESSION['user']['id']);
                                                ?>
                                            <table  class=" b-table-primary f-table-primary f-center">
                                                <?php if(empty($valida)){ ?>
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th><span><i class="fa fa-star star" id="califica_1"></i></span></th>
                                                        <th><span><i class="fa fa-star star" id="califica_2"></i></span></th>
                                                        <th><span><i class="fa fa-star star" id="califica_3"></i></span></th>
                                                        <th><span><i class="fa fa-star star" id="califica_4"></i></span></th>
                                                        <th><span><i class="fa fa-star star" id="califica_5"></i></span></th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><strong class="f-information-box__name b-information-box__name f-secondary-b">Calificar </strong></td>
                                                        <label>
                                                            <input type="hidden" class="id" value="">
                                                            <input type="hidden" class="idpro" value="<?php echo $_GET['id'] ?>">
                                                            <input type="hidden" class="iduser" value="<?php echo $_SESSION['user']['id'] ?>">
                                                            <td><input type="radio" name="califica" value="1" id="cal_1" class="califica" ></td>
                                                            <td><input type="radio" name="califica" value="2" id="cal_2" class="califica"></td>
                                                            <td><input type="radio" name="califica" value="3" id="cal_3" class="califica"></td>
                                                            <td><input type="radio" name="califica" value="4" id="cal_4" class="califica"></td>
                                                            <td><input type="radio" name="califica" value="5" id="cal_5" class="califica"></td>
                                                        </label>
                                                    </tr>

                                                    </tbody>
                                                <?php }else{ ?>

                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <?php
                                                    $cali=$valida->calificacion;
                                                    for($i=1;$i<=$cali;$i++){?>

                                                        <th><span><i class="fa fa-star star" style="color:#fcb92d;" id="califica_<?php echo $i ?>"></i></span></th>
                                                    <?php }
                                                    $resta=5-$cali;
                                                    for($i=$cali+1;$i<=5;$i++){ ?>
                                                        <th><span><i class="fa fa-star star" id="califica_<?php echo $i ?>"></i></span></th>
                                                    <?php } ?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><strong class="f-information-box__name b-information-box__name f-secondary-b">Calificar </strong></td>
                                                    <label>
                                                        <input type="hidden" class="id" value="<?php echo $valida->id ?>">
                                                        <input type="hidden" class="idpro" value="<?php echo $_GET['id'] ?>">
                                                        <input type="hidden" class="iduser" value="<?php echo $_SESSION['user']['id'] ?>">
                                                        <td><input type="radio" name="califica" value="1" id="cal_1" class="califica" ></td>
                                                        <td><input type="radio" name="califica" value="2" id="cal_2" class="califica"></td>
                                                        <td><input type="radio" name="califica" value="3" id="cal_3" class="califica"></td>
                                                        <td><input type="radio" name="califica" value="4" id="cal_4" class="califica"></td>
                                                        <td><input type="radio" name="califica" value="5" id="cal_5" class="califica"></td>
                                                    </label>
                                                </tr>

                                                </tbody>
                                                <?php } ?>
                                            </table>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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