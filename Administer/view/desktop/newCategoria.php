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
    $ic=new Icono(new Conexion());
    $iconos=$ic->getAll();
    if(isset($_POST['submit'])){
        $nombre= isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $posicion= isset($_POST['posicion']) ? $_POST['posicion'] : '';
        $icono= isset($_POST['icono']) ? $_POST['icono'] : '';
        if (empty($nombre) or empty($posicion) or empty($icono)){
            $param=[
                    'ms'=>'Llene todos los campos con asterísco (obligatorio)',
                    'clase'=>'alert-danger',
                    'alert'=>'Error'
                    ];
            header('Location: newCategoria.php?ms='.$param["ms"].'&clase='.$param["clase"].'&alert='.$param["alert"].'');
        }else {
            $categoria = new Categoria(new Conexion());
            $categoria->setNombre($nombre);
            $categoria->setPosicion($posicion);
            $categoria->setImg($icono);
            $resul = $categoria->save();
            $param=[
                'ms'=>'Categoría registrada exitosamente',
                'clase'=>'alert-success',
                'alert'=>'Exito'
            ];
            $cat=$categoria->getUltimoRegistro();

           header('Location: editCategoria.php?id='.$cat->id);

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
                                    <li class="breadcrumb-item active">Nueva Categoría </li>

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
                                        <form id="loginForm" action="newCategoria.php" method="POST"  class="form-horizontal" >
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group iconos">
                                                        <label><span class="text-label">*Icono</span><small> Seleccione un icono para la clasificación</small></label><br/>
                                                        <?php for($i=0; $i<count($iconos);$i++){?>
                                                            <label class="checkbox-inline"><input type="radio" name="icono" class="hidden" value="<?php echo $iconos[$i]->icon ?>"><h3 class="icono"><i class="<?php echo $iconos[$i]->icon ?>" ></i> </h3></label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">*Categoria</span></label>
                                                        <input class="form-control" type="text" name="nombre" placeholder="Nombre de categoría">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">*posicion</span></label>
                                                        <input class="form-control" type="text" name="posicion" placeholder="Posición en el menú">
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