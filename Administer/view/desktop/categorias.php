<?php
session_start();
spl_autoload_register(function ($clase) {
    include '../../class/'.$clase.'/'.$clase.'.php';
});
?>
<!doctype html>
<html class="fixed">
	<head>

	<?php include("../../llamadoshead.php");
	$categorias=new Categoria(new Conexion());
	$cat=$categorias->getAll(); ?>

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
                                    <li class="breadcrumb-item active">Categorías</li>
                                    <li>
                                        <div class="btn-group pb-2">
                                            <a type="button" class="btn btn-success" href="newCategoria.php"><i class="fas fa-plus"></i> Nueva categoría</a>
                                        </div>
                                    </li>
                                </ol>

                                <!-- Example DataTables Card-->
                                <div class="card mb-3 mt-1">
                                    <div class="card-body">
                                            <div class="table-responsive">
                                                <?php if(count($cat)<=0){ ?>
                                                    <tr><td colspan="2"><center>No hay categorías</center></td></tr>
                                                <?php }else{ ?>
                                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>Icono</th>
                                                        <th>Nombre</th>
                                                        <th>Posición</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Icono</th>
                                                        <th>Nombre</th>
                                                        <th>Posición</th>
                                                        <th></th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                        <?php foreach ($cat as $c){?>
                                                        <tr>
                                                            <td><h3 class="m-0"><i class="<?php echo $c->img ?>"></i></h3></td>
                                                            <td><?php echo $c->nombre?></td>
                                                            <td><?php echo $c->posicion?></td>

                                                            <td>


                                                                <a class="btn btn-danger btn-options" data-toggle="modal" data-target="#eliminarModal" title="Eliminar categoía" ><i class="fa fa-trash"></i></a>

                                                                <a class="btn btn-warning btn-options" data-toggle="tooltip" title="Editar categoría" href="editCategoria.php?id=<?php echo $c->id ?>"> <i class="fas fa-pencil-alt"></i></a>
                                                                <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title text-danger" id="exampleModalLabel">Eliminar Usuario</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Esta seguro de eliminar el usuario?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <a class="btn btn-danger btn-options" data-toggle="tooltip" title="Eliminar usuario" href="?controller=Usuarios&action=borrar&id="><i class="fa fa-trash"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                                <?php } ?>
                                            </div>

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


	</body>
</html>