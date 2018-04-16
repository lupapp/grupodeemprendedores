<?php
session_start();
if(isset($_SESSION['user'])){
    if($_SESSION['user']['tipo']==1){
        header('Location: view/desktop/index.php' );
    }else{
        header('Location: view/login/login.php' );
    }
}else{
    header('Location: view/login/login.php' );
}
?>