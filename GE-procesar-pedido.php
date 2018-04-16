<?php session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
date_default_timezone_set('America/Bogota');
if(isset($_POST['submit'])) {
    $pedido = new Pedido(new Conexion());
    $fecha = date('Y') . "-" . date('m') . "-" . date('d');
    $hora = date('g') . ":" . date('i') . " " . date('A');
    $cliente=$_SESSION['user']['id'];
    $metodo=$_POST['metodoPago'];
    $total=$_SESSION['total'];
    $pedido->setFecha($fecha);
    $pedido->setHora($hora);
    $pedido->setCliente($cliente);
    $pedido->setMetodoPago($metodo);
    $pedido->setTotal($total);
    $pedido->setEstado(0);
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
    $mensaje = include 'GE-pedido-cliente-mail.php';
    $to = $_SESSION['user']['mail'];
    $from = 'MIME-Version: 1.0' . "\r\n";
    $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $from .= 'To:' . $_SESSION['user']['mail'] . '' . "\r\n";
    $from .= 'From: Do_Not_reply@grupodeemprendedores.com' . "\r\n";
    date_default_timezone_set('America/Bogota');
    $tema = "Compra en linea";

    @mail($to, $tema, utf8_decode($mensaje), $from);
    unset($_SESSION['carrito']);
    unset($_SESSION['cantidad']);
    unset($_SESSION['total']);
    if($metodo=='paypal') {
        header('Location: GE-pedido-finalizado.php');
    }else{
        header('Location: GE-pedido-finalizado.php');
    }
}else{
    header('Location:index.php');
}

?>