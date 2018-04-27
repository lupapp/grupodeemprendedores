<?php
session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con=new Conexion();
$calificacion=new Calificacion($con);
$iduser= isset($_POST['iduser']) ? $_POST['iduser'] : '';
$idpro= isset($_POST['idpro']) ? $_POST['idpro'] : '';
$califica= isset($_POST['califica']) ? $_POST['califica'] : '';
$id=isset($_POST['id']) ? $_POST['id'] : '';
$verificado=$calificacion->verificar($idpro,$iduser);
$calificacion->setProducto($idpro);
$calificacion->setUser($_SESSION['user']['id']);
$calificacion->setCalificacion($califica);
if(empty($verificado)){
    $calificacion->save();
    $promedio = $calificacion->getPromedio($idpro);
}else{
    $calificacion->update($id);
}




