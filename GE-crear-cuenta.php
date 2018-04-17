<?php session_start();
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con = new Conexion();
$user=new User($con);
if(isset($_POST['submit'])) {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
    $pais = isset($_POST['pais']) ? $_POST['pais'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $repass = isset($_POST['repass']) ? $_POST['repass'] : '';

    if (empty($nombre) or empty($mail) or empty($usuario) or empty($pass)) {
        $param = [
            'ms' => 'Llene todos los campos con asterísco (obligatorio)',
            'clase' => 'alert-danger',
            'alert' => 'Error'
        ];
        header('Location: GE-shop_cart.php?param='.serialize($param));
    } else {
        if(strcmp($pass, $repass)===0) {
            $user->setPass($pass);
            $user->setUser($usuario);
            $user->setNombre($nombre);
            $user->setMail($mail);
            $user->setCelular($celular);
            $user->setTelefono($telefono);
            $user->setDireccion($direccion);
            $user->setCiudad($ciudad);
            $user->setPais($pais);
            $user->setTipo(2);
            $resul = $user->save();
            $u=$user->getUltimoRegistro();
            $_SESSION['user']=$u;
            $param = [
                'ms' => 'Usuario creado exitosamente',
                'clase' => 'alert-success',
                'alert' => 'Exito'
            ];
            header('Location: GE-shop_cart.php?param='.serialize($param));
        }else{
            $param = [
                'ms' => 'Las contraseñas no son iguales',
                'clase' => 'alert-danger',
                'alert' => 'Error'
            ];
            header('Location: GE-shop_cart.php?param='.serialize($param));
        }

    }
}

?>
<body style="height: 100%;width:100%;padding: 0;margin: 0; font-size: 48px; color:#ffac00; align:center; vertical-align: middle;">
<i class="fas fa-spinner"></i> Creando Cuenta
</body>
