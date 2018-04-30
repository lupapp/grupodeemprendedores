<?php
session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con=new Conexion();
$cupone=new Cupon($con);
$pedido=new Pedido($con);
$cupon=$_POST['cupon'];
$valor=$_POST['valor'];
$verif=$cupone->getExiste($cupon);
if($verif>0){
    $cup = $cupone->getByCupon($cupon);
    $des = $cup->descuento * $valor / 100;
    $newvalor = $valor - $des;
    echo $newvalor;
}else{
    echo 0;
}



