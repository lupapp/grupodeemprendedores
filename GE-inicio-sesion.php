<?php session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con = new Conexion();
if(isset($_POST['submit'])){

    $pass= isset($_POST['pass']) ? $_POST['pass'] : '';
    $user= isset($_POST['user']) ? $_POST['user'] : '';
    if (empty($pass) or empty($user)) {
        $param = [
            'ms' => 'Usuario no existe o contraseña incorrecta',
            'clase' => 'alert-danger',
            'alert' => 'Error'
        ];
        header('Location: GE-shop_cart.php?param='.serialize($param));
    }else{
        $login = new Login($con);
        $login->setPass($pass);
        $login->setUser($user);
        $login->setMail($user);
        $resul = $login->signIn();
        echo $resul['existe'];
        if ($resul['existe'] == 1) {
            $_SESSION['user'] = $resul['user'];
            $param = [
                'ms' => 'Ingreso correctamente',
                'clase' => 'alert-success',
                'alert' => 'Exito'
            ];
            header('Location: GE-shop_cart.php?param='.serialize($param));
        } else {
            $param = [
                'ms' => 'Usuario no existe o contraseña incorrecta',
                'clase' => 'alert-danger',
                'alert' => 'Error'
            ];
            header('Location: GE-shop_cart.php?param='.serialize($param));
        }
    }
}

?>

