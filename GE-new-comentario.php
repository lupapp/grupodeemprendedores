<?php
session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con=new Conexion();
$comentario=new Comentario($con);
if(isset($_POST['enviocoment'])){
$coment= isset($_POST['comentario']) ? $_POST['comentario'] : '';
$idpro= isset($_POST['idpro']) ? $_POST['idpro'] : '';
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
        $comentario->setProducto($idpro);
        $comentario->setEstado('1');
        $comentario->setFecha($fecha);
        $comentario->setHora($hora);
        $comentario->save();
        $param = [
            'ms' => 'Comentario registrado',
            'clase' => 'alert-success',
            'alert' => 'Exito'
        ];
    }
        header('Location:GE-shop_detalle.php?id='.$idpro.'&ms='.$param["ms"].'&clase='.$param["clase"].'&alert='.$param["alert"]);
}
