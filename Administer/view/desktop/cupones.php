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
	$cone=new Conexion();
	$cupon=new Cupon($cone);
    if(isset($_GET['id'])){
        $id=$_GET["id"];
        $cupon->delete($id);

        header('location:cupones.php');
    }
	?>
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
                            <?php

                            if (!isset($param)){}else{?>

                                <div class="alert <?php echo $param['clase'] ?>">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong><?php echo $param['alert'].":"; ?></strong> <?php echo $param['ms'] ?>
                                </div>
                            <?php } ?>
                            <div class="container-fluid">
                                <!-- Breadcrumbs-->
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.php"><i class="fas fa-home"></i> Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item active">Cupones</li>
                                    <li>
                                        <div class="btn-group pb-2">
                                            <a type="button" class="btn btn-success" href="newCupon.php"><i class="fas fa-plus"></i> Generar cupones</a>
                                        </div>
                                    </li>
                                </ol>

                                <!-- Example DataTables Card-->
                                <div class="card mb-3 mt-1">
                                    <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>Cupón</th>
                                                        <th>Fecha</th>
                                                        <th>Descuento</th>
                                                        <th>Estado</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Cupón</th>
                                                        <th>Fecha</th>
                                                        <th>Descuento</th>
                                                        <th>Estado</th>
                                                        <th></th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        <?php
                                                        $cup=$cupon->getAll();
                                                        if(count($cup)>0) {
                                                            foreach ($cup as $c) {
                                                                ?>
                                                                <tr>
                                                                    <td class="w-10">
                                                                        <?php
                                                                        echo $c->cupon;
                                                                       ?>
                                                                    </td>
                                                                    <td><?php

                                                                        echo $c->fecha ?></td>
                                                                    <td><?php echo $c->descuento ?></td>
                                                                    <td>
                                                                        <?php switch($c->estado){
                                                                            case 0: $estado='Disponible';
                                                                                break;
                                                                            case 1: $estado='Usado';
                                                                                break;
                                                                        } echo $estado;?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-danger btn-options"
                                                                           data-toggle="modal"
                                                                           data-target="#eliminarModal"
                                                                           title="Eliminar cupón"><i
                                                                                    class="fa fa-trash"></i></a>

                                                                        <div class="modal fade" id="eliminarModal"
                                                                             tabindex="-1" role="dialog"
                                                                             aria-labelledby="eliminarModalLabel"
                                                                             aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title text-danger"
                                                                                            id="exampleModalLabel">
                                                                                            Eliminar cupón</h5>
                                                                                        <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Esta seguro de eliminar el cupón?
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">
                                                                                            Close
                                                                                        </button>
                                                                                        <a class="btn btn-danger btn-options"
                                                                                           data-toggle="tooltip"
                                                                                           title="Eliminar cupón"
                                                                                           href="cupones.php?id=<?php echo $c->id ?>"><i
                                                                                                    class="fa fa-trash"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                        }else{ ?>
                                                            <tr><td colspan="8" align="center">No hay cupones</td></tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
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