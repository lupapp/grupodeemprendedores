<?php
session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con=new Conexion();
$cupone=new Cupon($con);
$cupon=$_POST['cupon'];
$valor=$_POST['valor'];
$verif=$cupone->getExiste($cupon);
$existe='si';
$numero=0;
if(isset($_SESSION['carrito'])){
    $arreglo=$_SESSION['carrito'];
    for($i=0;$i<count($arreglo);$i++){
        if($arreglo[$i]['cupon']==$cupon){
            $existe='no';
        }
    }
}
if($verif=='si'){
    if($existe=='si') {
        $cup = $cupone->getByCupon($cupon);
        $des = $cup->descuento * $valor / 100;
        $newvalor = $valor - $des;
        echo $newvalor;
    }else{
        echo 1;
    }
}else{
    echo 0;
}



