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

    if(isset($_POST['submit'])){
        $nombre= isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $valor= isset($_POST['valor']) ? $_POST['valor'] : '';
        $borrar= isset($_POST['borrar']) ? $_POST['borrar'] : '';
        $estado= isset($_POST['estado']) ? $_POST['estado'] : '';

        if (empty($nombre) or empty($valor) or empty($borrar) or empty($estado)){
            $param=[
                    'ms'=>'Llene todos los campos con asterísco (obligatorio)',
                    'clase'=>'alert-danger',
                    'alert'=>'Error'
                    ];
        }else {
            $options = new Options(new Conexion());
            $options->setName($nombre);
            $options->setValor($valor);
            $options->setBorrar($borrar);
            $options->setEstado($estado);
            $resul = $options->save();
            $param=[
                'ms'=>'Ajuste registrado exitosamente',
                'clase'=>'alert-success',
                'alert'=>'Exito'
            ];

            header('Location: ajustes.php');

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
                                    <li class="breadcrumb-item active">Nuevo ajuste </li>

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
                                            <a href="categorias.php" class="btn btn-primary pull-right cursor-pointer mr-1" >Finalizar</a>
                                        </div>
                                    <?php }?>
                                    <div class="card-body ">
                                        <form id="loginForm" action="newAjuste.php" method="POST"  class="form-horizontal" >
                                            <div class="form-row">

                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">*Nombre</span></label>
                                                        <input class="form-control" type="text" name="nombre" placeholder="Escriba un nombre para el ajuste">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">*Valor</span></label>
                                                        <input class="form-control" type="text" name="valor" placeholder="Valor del ajuste">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">Se puede borrar</span></label>
                                                        <select class="form-control" name="borrar" id="exampleFormControlSelect1">
                                                                <option value="no">No</option>
                                                                <option value="si">Si</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">Estado</span></label>
                                                        <select class="form-control" name="estado" id="exampleFormControlSelect1">
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary btn-lg pull-right cursor-pointer" ><i class="fas fa-save"></i> Guardar</button>
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
        <script>
            CKEDITOR.replace('deslarga');
            CKEDITOR.replace('descorta',
                {
                    height:70
                });
        </script>


	</body>
</html>