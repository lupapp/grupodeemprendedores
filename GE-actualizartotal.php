<?php
@session_start();

if(!isset($_SESSION['total'])){
    echo "<script>
        $('.totalCart').fadeOut();
        </script> 
        0
    ";
}else{
    $c=$_SESSION['total'];
    echo"
        <script>
        $('.totalCart').fadeIn();
        </script> 
        ".$c."";
}
?>
