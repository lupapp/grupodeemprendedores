<?php session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
echo '<link type="text/css" data-themecolor="default" rel="stylesheet" href="css/main-default.css">
<div id="myLoading" class="myloading" payu-loading="" style="display: block;">
    
        <div class="animate-loading">
            <img class="animate-image" src="https://s02cdn.payulatam.com/4.9.49/app/dist/images/common/loading-.png">
            <!--[if lt IE 9]>
                    <img  src="https://s02cdn.payulatam.com/4.9.49/app/dist/images/common/gif-load.gif" />
            <![endif]-->
        </div>

    <div class="message-loading no-show" style="display: block;">
        <p id="message-loading-text" class="message-loading-text-small ng-binding" style="display: block;"></p>
        <!--[if lt IE 9]>
            <p class="message-loading-text-big browsehappy" style="width: 80%;margin:auto;" translate="index.browser_not_supported">La versión de tu navegador no es la ideal para ver correctamente este portal. Por favor actualiza tu navegador o ingresa al portal desde un navegador diferente.</p>
        <![endif]-->
    </div>
</div>';
echo '<script src="js/jquery/jquery-1.11.1.min.js"></script>';
date_default_timezone_set('America/Bogota');
    $pedido = new Pedido(new Conexion());
    $fecha = date('Y') . "-" . date('m') . "-" . date('d');
    $hora = date('g') . ":" . date('i') . " " . date('A');
    $des=$_REQUEST['des'];
    $total=$_REQUEST['precio'];
    $cupon=$_REQUEST['cupon'];
    $cliente = $_SESSION['user']['id'];
    if (isset($_SESSION['metodo'])) {
        $metodo = $_SESSION['metodo'];
    } else {
        $metodo = $_POST['metodoPago'];
    }   
    $pedido->setFecha($fecha);
    $pedido->setHora($hora);
    $pedido->setCliente($cliente);
    $pedido->setMetodoPago($metodo);
    $pedido->setTotal($total);
    $pedido->setEstado(0);
    $pedido->setCupon($cupon);
    $pedido->setDescuento($des);
    $ped = $pedido->getUltimoRegistro();
    $linea = new LineaPedido(new Conexion());
    $datos = $_SESSION['carrito'];
    foreach ($datos as $d) {
        $totalLinea = $d['cant'] * $d['price'];
        $linea->setPedido($ped->id);
        $linea->setImg($d['img']);
        $linea->setNomPro($d['nombre']);
        $linea->setCantidad($d['cant']);
        $linea->setIdPro($d['id']);
        $linea->setValorPro($d['price']);
        $linea->setTotalLinea($totalLinea);
        $linea->save();
    }
    $cupones=new Cupon(new Conexion());
    $cupones->setEstado(1);
     $cupones->setPedido($ped->id);
     $cupones->update($cupon);
    include 'GE-pedido-cliente-mail.php';
    $to = $_SESSION['user']['mail'];
    $from = 'MIME-Version: 1.0' . "\r\n";
    $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $from .= 'To:' . $_SESSION['user']['mail'] . '' . "\r\n";
    $from .= 'From: Do_Not_reply@grupodeemprendedores.com' . "\r\n";
    date_default_timezone_set('America/Bogota');
    $tema = "Compra en linea";

    @mail($to, $tema, utf8_decode($mensaje), $from);

    if (isset($_SESSION['metodo'])) {
        unset($_SESSION['metodo']);
    } else {

    }
    unset($_SESSION['carrito']);
    unset($_SESSION['cantidad']);

    if ($metodo == 'payu') {
        $sig = "1XAlMeg5k6vZ3XUjxwHYV3vQP6~719306~" . time() . "~" . $total . "~COP";
        $sigMd5 = md5($sig);
        $amount = $total;
        unset($_SESSION['total']);
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
        unset($_SESSION['total']);
        //header('Location: GE-pedido-finalizado.php');
    }

?>