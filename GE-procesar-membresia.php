<?php session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
echo '<script src="js/jquery/jquery-1.11.1.min.js"></script>';
$login=new Login(new Conexion());
$pass= isset($_POST['pass']) ? $_POST['pass'] : '';
$user= isset($_POST['user']) ? $_POST['user'] : '';
if (empty($pass) or empty($user)) {
    $param = [
        'ms' => 'Usuario no existe o contraseña incorrecta',
        'clase' => 'alert-danger',
        'alert' => 'Error'
    ];

}else{
    $login->setPass($pass);
    $login->setUser($user);
    $login->setMail($user);
    $resul = $login->signIn();
    if ($resul['user'] != '') {
        $_SESSION['user'] = $resul['user'];
        $param = [
            'ms' => 'Ingreso correctamente',
            'clase' => 'alert-success',
            'alert' => 'Exito'
        ];
        header('Location:GE-procesar-membresia.php');
    } else {
        $param = [
            'ms' => 'Usuario no existe o contraseña incorrecta',
            'clase' => 'alert-danger',
            'alert' => 'Error'
        ];

    }
}
if(isset($_SESSION['user'])) {

    date_default_timezone_set('America/Bogota');
    $pedido = new Pedido(new Conexion());
    $membresia=new Membresia(new Conexion());
    $fecha = date('Y') . "-" . date('m') . "-" . date('d');
    $hora = date('g') . ":" . date('i') . " " . date('A');
    $vencimiento=$membresia->fechaVencimiento($fecha,1);
    $des = 0;
    $total = $_REQUEST['precio'];
    $cupon = '';
    $dolar=$_POST['dolar'];
    $cliente = $_SESSION['user']['id'];
    $metodo=$_POST['metodoPago'];
    $producto=$_POST['producto'];
    $img=$_POST['img'];
    $idpro=$_POST['idpro'];

    $pedido->setFecha($fecha);
    $pedido->setHora($hora);
    $pedido->setCliente($cliente);
    $pedido->setMetodoPago($metodo);
    $pedido->setTotal($total);
    $pedido->setEstado(0);
    $pedido->setCupon($cupon);
    $pedido->setDescuento($des);
    $pedido->save();
    $ped = $pedido->getUltimoRegistro();
    $linea = new LineaPedido(new Conexion());
    $linea->setPedido($ped->id);
    $linea->setImg($img);
    $linea->setNomPro($producto);
    $linea->setCantidad(1);
    $linea->setIdPro($idpro);
    $linea->setValorPro($total);
    $linea->setTotalLinea($total);
    $linea->save();
    $membresia->setId_pro($idpro);
    $membresia->setId_user($cliente);
    $membresia->setValor($total);
    $membresia->setFecha($fecha);
    $membresia->setVencimiento($vencimiento);
    $membresia->setEstado('1');
    $membresia->save();
    include 'GE-pedido-membresia-mail.php';
    $to = $_SESSION['user']['mail'];
    $from = 'MIME-Version: 1.0' . "\r\n";
    $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $from .= 'To:' . $_SESSION['user']['mail'] . '' . "\r\n";
    $from .= 'From: Do_Not_reply@grupodeemprendedores.com' . "\r\n";
    date_default_timezone_set('America/Bogota');
    $tema = "Compra membresía";

    @mail($to, $tema, utf8_decode($mensaje), $from);

    if ($metodo == 'payu') {
        $sig = "1XAlMeg5k6vZ3XUjxwHYV3vQP6~719306~" . time() . "~" . $total . "~COP";
        $sigMd5 = md5($sig);
        $amount = $total;
        echo '<form action="https://checkout.payulatam.com/ppp-web-gateway-payu/" method="post" class="formpayu">
        <input name="merchantId"    type="hidden"  value="719306"   >
        <input name="accountId"     type="hidden"  value="724178" >
        <input name="description"   type="hidden"  value="Pago con Payu"  >
        <input name="referenceCode" type="hidden"  value="' . time() . '" >
        <input name="amount"        type="hidden"  value="' . $amount . '"   >
        <input name="tax"           type="hidden"  value="0"  >
        <input name="taxReturnBase" type="hidden"  value="0" >
        <input name="currency"      type="hidden"  value="COP" >
        <input name="signature"     type="hidden"  value="' . $sigMd5 . '"  >
        <input name="buyerFullName"  type="hidden"  value="' . $_SESSION['user']['nombre'] . '">
        <input name="shippingAddress"          type="hidden"  value="' . $_SESSION['user']['direccion'] . '">
        <input name="shippingCity"          type="hidden"  value="' . $_SESSION['user']['ciudad'] . '">
        <input name="shippingCountry"          type="hidden"  value="' . $_SESSION['user']['pais'] . '">
        <input name="telephone"          type="hidden"  value="' . $_SESSION['user']['movil'] . '">
        <input name="buyerEmail"    type="hidden"  value="' . $_SESSION['user']['mail'] . '" >
        <input name="responseUrl"    type="hidden"  value="http://grupodeemprendedores.com/index/GE-pedido-finalizado.php" >
        <input name="confirmationUrl"    type="hidden"  value="http://grupodeemprendedores.com/index/GE-pedido-finalizado.php" >
        <script>
        $(".formpayu").submit();
        </script>';
    } else {
        if($metodo == 'paypal'){
        echo '<form action="paypal/comprar.php" method="post" class="formpaypal">
            <input type="hidden" class="cupon" name="cupon" value="'.$cupon.'">
            <input type="hidden" name="des" class="des"  value="'.$des.'">
            <input type="hidden" name="dolar" class="dolar"  value="'.$dolar.'">
            <input type="hidden" name="precio" class="total"  value="'.$total.'">
            <input type="hidden" name="metodoPago"  value="paypal">
            </form>
            <script>
            $(".formpaypal").submit();
            </script>';
        }else{
            header('Location: GE-pedido-finalizado.php');
        }
    }
}else{


    if (isset($param)){?>
        <div class="alert <?php echo $param['clase'] ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $param['alert'].":"; ?></strong> <?php echo $param['ms'] ?>
        </div>
    <?php } ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Compra :: login</title>
            <link rel="shortcut icon" href="favicon.ico">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
            <link type="text/css" rel='stylesheet' href="js/bxslider/jquery.bxslider.css">
            <link type="text/css" rel='stylesheet' href="js/flexslider/flexslider.css">
            <link type="text/css" rel='stylesheet' href="js/radial-progress/style.css">
            <link type="text/css" rel='stylesheet' href="css/animate.css">
            <link type="text/css" rel='stylesheet' href="js/jqueryui/jquery-ui.css">
            <link type="text/css" rel='stylesheet' href="js/jqueryui/jquery-ui.structure.css">
            <link type="text/css" rel='stylesheet' href="js/fancybox/jquery.fancybox.css">
            <link type="text/css" rel='stylesheet' href="fonts/fonts.css">
            <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
            <link type="text/css" data-themecolor="default" rel='stylesheet' href="css/main-default.css">
            <link type="text/css" rel='stylesheet' href="js/rs-plugin/css/settings.css">
            <link type="text/css" rel='stylesheet' href="js/rs-plugin/css/settings-custom.css">
            <link type="text/css" rel='stylesheet' href="js/rs-plugin/videojs/video-js.css">
            <script src="js/jquery/jquery-1.11.1.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            </head>
            <body>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 ">
                    <div class="card mt-5">

                        <div class="card-header">
                            Inicio de sesión
                        </div>
                        <div class="card-body">
                            <div class="b-form-row b-form-inline b-form-horizontal">
                                <form action="GE-procesar-membresia.php" method="post">
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
                                        <div class="b-form-row">
                                            <div class="b-form-horizontal__label"></div>
                                            <label for="contact_form_copy" class="b-contact-form__window-form-row-label">
                                                <input type="checkbox" id="contact_form_copy" class="b-form-checkbox" />
                                                <span>Recordarme</span>
                                            </label>
                                        </div>
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
                    </div>
                </div>
            </div>
        </body>
    </html>
<?php }?>
