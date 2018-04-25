<?php
session_start();
spl_autoload_register(function ($clase) {
    include '../../class/'.$clase.'/'.$clase.'.php';
});

?>
<!doctype html>
<html class="fixed">
	<head>
    <?php
    $con=new Conexion();
    $user = new User($con);
    if(isset($_POST['reset'])){
        $pass=$user->gPass();
        $id=$_GET['id'];
        $user->setPass($pass['pass']);
        $user->reset($id);
        include '../mensajes/resetPass.php';
        $to = $mail;
        $from = 'MIME-Version: 1.0' . "\r\n";
        $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $from .= 'To:' . $mail . '' . "\r\n";
        $from .= 'From: Do_Not_reply@grupodeemprendedores.com' . "\r\n";
        date_default_timezone_set('America/Bogota');
        $tema = "Reseteo de Contraseña";

        @mail($to, $tema, utf8_decode($mensaje), $from);
        $param = [
            'ms' => 'Se reseteo la contraseña',
            'clase' => 'alert-success',
            'alert' => 'Exito'
        ];

    }
    if(isset($_POST['submit'])) {
        $id = $_GET['id'];
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
        $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
        $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
        $pais = isset($_POST['pais']) ? $_POST['pais'] : '';
        $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';

        if (empty($nombre) or empty($mail)) {
            $param = [
                'ms' => 'Llene todos los campos con asterísco (obligatorio)',
                'clase' => 'alert-danger',
                'alert' => 'Error'
            ];
        } else {
            if($pass!='') {
                if(strcmp($pass, $repass)===0) {
                    $user->setPass($pass);
                }else{
                    $param = [
                        'ms' => 'Las contraseñas no son iguales',
                        'clase' => 'alert-danger',
                        'alert' => 'Error'
                    ];

                    header('Location:GE-micuenta.php');
                    exit;
                }
            }
            $user->setNombre($nombre);
            $user->setMail($mail);
            $user->setCelular($celular);
            $user->setTelefono($telefono);
            $user->setDireccion($direccion);
            $user->setCiudad($ciudad);
            $user->setPais($pais);
            $user->setTipo($tipo);
            $resul = $user->update($id);

            $param = [
                'ms' => 'Usuario actualizado exitosamente',
                'clase' => 'alert-success',
                'alert' => 'Exito'
            ];
        }
    }?>
	<?php include("../../llamadoshead.php"); ?>
    <link rel="stylesheet" href="../../assets/css/dropzone.css" />
    <link rel="stylesheet" href="../../assets/css/basic.css" />
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<?php include("../../header.php"); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include("../../nav.php");?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">

					<header class="page-header">
						<h2>Acceso Administrador</h2>

					</header>

						<section class="panel">

                            <div class="container-fluid">
                                <!-- Breadcrumbs-->
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.php"><i class="fas fa-home"></i> Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item active">Nuevo Producto </li>

                                </ol>

                                <!-- Example DataTables Card-->
                                <div class="card mb-3 mt-1">
                                    <?php

                                    if (!isset($param)){}else{?>

                                        <div class="alert <?php echo $param['clase'] ?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong><?php echo $param['alert'].":"; ?></strong> <?php echo $param['ms'] ?>
                                            <a href="articulos.php" class="btn btn-primary pull-right cursor-pointer mr-1" >Finalizar</a>
                                        </div>
                                    <?php } ?>
                                    <div class="card-body ">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="editUsuario.php?id=<?php echo $_GET['id']?>" method="post">
                                                    <button class="btn btn-info pull-right" name="reset"><i class="fas fa-redo"></i> Resetear contraseña</button>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                        $usu=$user->getById($_GET['id']);
                                        ?>
                                        <form id="loginForm" action="editUsuario.php?id=<?php echo $_GET['id'] ?>" method="POST"  class="form-horizontal" >
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputUser"><span class="text-label">*Usuario</span></label>
                                                        <input  type="hidden" name="usuario" value="<?php echo $usu->usuario ?>">
                                                        <input class="form-control" id="exampleInputUser" type="text"  value="<?php echo $usu->usuario ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputUser"><span class="text-label">*Nombre del usuario</span></label>
                                                        <input class="form-control" type="text" name="nombre" placeholder="Stock" value="<?php echo $usu->nombre ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">*Correo electrónico</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="mail" name="mail" aria-describedby="usuario" value="<?php echo $usu->mail ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputUser"><span class="text-label">*Tipo de usuario</span></label>
                                                        <?php
                                                        switch ($usu->tipo){
                                                            case 1: $tipo='Admin';
                                                                break;
                                                            case 2:$tipo='Básico';
                                                                break;
                                                        }?>
                                                        <select name="tipo">
                                                            <option value="<?php echo $usu->tipo ?>"><?php echo $tipo ?></option>
                                                            <option value="2">Basico</option>
                                                            <option value="1">Admin</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">Teléfono</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="telefono" aria-describedby="usuario" value="<?php echo $usu->telefono ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">Celular</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="celular" aria-describedby="usuario" value="<?php echo $usu->telefono ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">Dirección</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="direccion" aria-describedby="usuario" value="<?php echo $usu->telefono ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">Ciudad</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="ciudad" aria-describedby="usuario" value="<?php echo $usu->ciudad ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">País</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="ciudad" aria-describedby="usuario" value="<?php echo $usu->pais ?>" >
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary pull-right cursor-pointer" ><i class="fas fa-save"></i> Guardar</button>
                                        </form>

                                    </div>
                                </div>
                            </div>


						</section>
					<!-- end: page -->
				</section>
			</div>

			
		</section>

		<!-- Vendor -->

        <?php include("../../footer.php"); ?>
        <script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
        <script src="../../assets/js/dropzone.js"></script>




	</body>
</html>