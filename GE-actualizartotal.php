<?php
@session_start();

if(!isset($_SESSION['total'])){
    echo 0;
}else{
    $c=number_format($_SESSION['total'],2,',','.');
    echo $c;
}
?>
