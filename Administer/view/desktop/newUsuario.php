<?php
session_start();
spl_autoload_register(function ($clase) {
    include '../../class/'.$clase.'/'.$clase.'.php';
});
$con=new Conexion();
?>
<!doctype html>
<html class="fixed">
	<head>
    <?php
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
        $pass = $user->gPass();

        if (empty($nombre) or empty($mail) or empty($usuario)) {
            $param = [
                'ms' => 'Llene todos los campos con asterísco (obligatorio)',
                'clase' => 'alert-danger',
                'alert' => 'Error'
            ];
        } else {
            $user->setPass($pass['pass']);
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
            $param = [
                'ms' => 'Usuario creado exitosamente',
                'clase' => 'alert-success',
                'alert' => 'Exito'
            ];
            include '../mensajes/mensajeNuevoUser.php';
            $to = $mail;
            $from = 'MIME-Version: 1.0' . "\r\n";
            $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $from .= 'To:' . $mail . '' . "\r\n";
            $from .= 'From: Do_Not_reply@grupodeemprendedores.com' . "\r\n";
            date_default_timezone_set('America/Bogota');
            $tema = "Registro de usuario";

            @mail($to, $tema, utf8_decode($mensaje), $from);
            header('Location: usuarios.php');
        }
    }
    ?>

	<?php include("../../llamadoshead.php"); ?>

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
                                    <li class="breadcrumb-item active">Nuevo Producto</li>

                                </ol>
                                <!-- Example DataTables Card-->
                                <div class="card mb-3 mt-1">
                                    <?php
                                    if(!isset($ms)) {
                                        $ms = $pass = isset($_GET['ms']) ? $_GET['ms'] : '';
                                    }
                                    if (empty($ms)){}else{?>

                                        <div class="alert <?php echo $_GET['clase'] ?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong><?php echo $_GET['alert'].":"; ?></strong> <?php echo $ms ?>
                                            <a href="articulos.php" class="btn btn-primary pull-right cursor-pointer mr-1" >Finalizar</a>
                                        </div>
                                    <?php }?>
                                    <div class="card-body ">
                                        <form id="loginForm" action="newUsuario.php" method="POST"  class="form-horizontal" >
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputUser"><span class="text-label">*Usuario</span></label>
                                                        <input class="form-control" id="exampleInputUser" name="usuario" type="text" placeholder="Usuario" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputUser"><span class="text-label">*Nombre del usuario</span></label>
                                                        <input class="form-control" type="text" name="nombre" placeholder="Nombre de usuario" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">*Correo electrónico</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="mail" name="mail" aria-describedby="usuario" placeholder="micorreo@correo.com" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputUser"><span class="text-label">*Tipo de usuario</span></label>
                                                        <select name="tipo">
                                                            <option alue="2">Básico</option>
                                                            <option alue="1">Admin</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">Teléfono</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="telefono" aria-describedby="usuario" placeholder="Número de teléfono fijo" >
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">Celular</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="celular" aria-describedby="usuario" placeholder="Número de celular">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">Dirección</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="direccion" aria-describedby="usuario" placeholder="Dirección de residencia">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">Ciudad</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="ciudad" aria-describedby="usuario" Placeholder="Ciudad de residencia">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">País</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="pais" aria-describedby="usuario" placeholder="País de residencia" >
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



	</body>
</html>