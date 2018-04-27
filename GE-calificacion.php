<?php
session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con=new Conexion();
$calificacion=new Calificacion($con);
$idpro=$_GET['id'];
$cantidad=$calificacion->getByIdProducto($idpro);
$promedio=$calificacion->getPromedio($idpro);
echo '<div class="b-product-card__info_title f-primary-b f-title-smallest">Valoración</div>
    <div class="b-stars-group f-stars-group b-margin-right-standard">';
    for($i=1;$i<=$promedio;$i++) {
        echo '<i class="fa fa-star is-active-stars"></i>';
    }
   echo '</div>
    <span class="f-primary-b c-tertiary f-title-smallest"> ('.count($cantidad).' opiniones)</span>';


