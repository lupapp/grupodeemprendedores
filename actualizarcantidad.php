<?php
@session_start();

if(!isset($_SESSION['cantidad'])){
    echo "<script>
        $('.cantCart').fadeOut();
        </script> 
        0
    ";
}else{
    $c=$_SESSION['cantidad'];
    echo"
        <script>
        $('.cantCart').fadeIn();
        </script> 
        ".$c."";
}
?>
