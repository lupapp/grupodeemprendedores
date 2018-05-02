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
	$con=new Conexion();
	$membresia=new Membresia($con);
	$producto=new Producto($con);
	$user=new User($con);
	$mem=$membresia->getAll();
    if(isset($_GET['id'])){
        if(isset($_GET['action'])) {
            $id = $_GET["id"];
            $membresia->delete($id);
        }
        $mem=$membresia->getById($_GET['id']);
        $newfecha=$membresia->fechaVencimiento($mem->vencimiento,1);
        $membresia->setVencimiento($newfecha);
        $membresia->setEstado(0);
        $membresia->update($_GET['id']);
        header('location:membresias.php');
    } ?>
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
                                    <li class="breadcrumb-item active">Membresías</li>
                                </ol>

                                <!-- Example DataTables Card-->
                                <div class="card mb-3 mt-1">
                                    <div class="card-body">
                                            <div class="table-responsive">
                                                <?php if(count($mem)<=0){ ?>
                                                    <tr><td colspan="2"><center>No hay membresías</center></td></tr>
                                                <?php }else{ ?>
                                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>Membresía</th>
                                                        <th>Membresía</th>
                                                        <th>Valor</th>
                                                        <th>Usuario</th>
                                                        <th>Fecha suscripción</th>
                                                        <th>Fecha vencimiento</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Membresía</th>
                                                        <th>Membresía</th>
                                                        <th>Valor</th>
                                                        <th>Usuario</th>
                                                        <th>Fecha suscripción</th>
                                                        <th>Fecha vencimiento</th>
                                                        <th></th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                        <?php foreach ($mem as $m){
                                                            $ver=$membresia->verificarVencimiento($m->vencimiento);
                                                            ?>
                                                        <tr <?php if($ver<=0){echo 'class="bdanger"';} ?> >
                                                            <td class="w-10"><?php
                                                                $pro=$producto->getById($m->id_pro);
                                                                $u=$user->getById($m->id_user);
                                                                if ($m->img_pro!='') { ?>
                                                                    <img class="img-thumbnail"
                                                                         src="../../public/img/<?php echo $m->img_pro ?>"/>
                                                                <?php } else {
                                                                    ?>
                                                                    <img class="img-thumbnail"
                                                                         src="../../public/img/without.jpg ?>"/>
                                                                <?php } ?>
                                                            <td><?php echo $pro->name?></td>
                                                            <td><?php echo $pro->valor?></td>
                                                            <td><?php echo $u->usuario." | ".$u->nombre ?></td>
                                                            <td><?php echo $m->fecha?></td>
                                                            <td><?php echo $m->vencimiento?></td>
                                                            <td>

                                                                <a href="membresias.php?id=<?php echo $m->id ?>" class="btn btn-success btn-options" data-toggle="tooltip" title="Activar" ><i class="fa fa-check"></i></a>
                                                                <a class="btn btn-danger btn-options" data-toggle="modal" data-target="#eliminarModal" title="Eliminar membresía" ><i class="fa fa-trash"></i></a>
                                                                <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title text-danger" id="exampleModalLabel">Eliminar Membresía</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Esta seguro de eliminar la membresía?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <a class="btn btn-danger btn-options" data-toggle="tooltip" title="Eliminar membresía" href="membresias.php?action=delete&id=<?php echo $m->id ?>"><i class="fa fa-trash"></i></a>
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