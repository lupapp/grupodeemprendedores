<?php
@session_start();

if(!isset($_SESSION['total'])){
    echo 0;
}else{
    $c=$_SESSION['total'];
    echo $c;
}
?>
