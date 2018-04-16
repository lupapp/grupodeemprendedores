<?php
// *** Logout the current user.
spl_autoload_register(function ($clase) {
    include '../../class/'.$clase.'/'.$clase.'.php';
});
$login = new Login(new Conexion());
$login->logout();
?>
