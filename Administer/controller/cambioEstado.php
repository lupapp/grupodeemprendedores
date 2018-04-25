<?php
session_start();
spl_autoload_register(function ($clase) {
    include '../class/'.$clase.'/'.$clase.'.php';
});
$cone=new Conexion();
$pedido=new Pedido($cone);
$pedidos=$pedido->getAll();
$id=$_REQUEST["id"];
$pedido->setEstado($_REQUEST['estado']);
$pedido->update($id);
if(isset($_REQUEST['edit'])){
    header('location:../view/desktop/editPedido.php?id='.$id);
}else {
    header('location:../view/desktop/pedidos.php');
}
?>