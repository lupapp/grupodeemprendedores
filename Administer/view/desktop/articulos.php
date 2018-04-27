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
	$procuto=new Producto($cone);
	$productos=$procuto->getAll();
	$imagen=new Imagen($cone);
	$clas=new Clasificacion($cone);
	$cat=new Categoria($cone);
    if(isset($_GET['id'])){
        $id=$_GET["id"];
        $procuto->delete($id);
        $imgs=$imagen->getByProd($id);
        foreach ($imgs as $img) {
            $b = $imagen->delete($img->id);
            unlink('../../public/img/'.$img->imagen);
            $imagen->delete($img->id);
        }
        header('location:articulos.php');
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

                            <div class="container-fluid">
                                <!-- Breadcrumbs-->
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.php"><i class="fas fa-home"></i> Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item active">Productos</li>
                                    <li>
                                        <div class="btn-group pb-2">
                                            <a type="button" class="btn btn-success" href="newProducto.php"><i class="fas fa-plus"></i> Nuevo producto</a>
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
                                                        <th>Imagen</th>
                                                        <th>Refencia</th>
                                                        <th>Nombre</th>
                                                        <th>Valor</th>
                                                        <th>Categoría</th>
                                                        <th>Stock</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Imagen</th>
                                                        <th>Refencia</th>
                                                        <th>Nombre</th>
                                                        <th>Valor</th>
                                                        <th>Categoría</th>
                                                        <th>Stock</th>
                                                        <th></th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        <?php
                                                        if(count($productos)>0) {
                                                            foreach ($productos as $p) {
                                                                ?>
                                                                <tr>
                                                                    <td class="w-10"><?php
                                                                        $im = $imagen->getFirst($p->id);
                                                                        if (isset($im->imagen)) { ?>
                                                                            <img class="img-thumbnail"
                                                                                 src="../../public/img/<?php echo $im->imagen ?>"/>
                                                                        <?php } else {
                                                                            ?>
                                                                            <img class="img-thumbnail"
                                                                                 src="../../public/img/without.jpg ?>"/>

                                                                        <?php } ?>
                                                                    </td>
                                                                    <td><?php echo $p->id ?></td>
                                                                    <td><?php echo $p->name ?></td>
                                                                    <td><?php echo $p->valor ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $cate = $cat->getById($p->categoria);
                                                                        echo $cate->nombre; ?>
                                                                    </td>

                                                                    <td><?php echo $p->stock ?></td>
                                                                    <td>
                                                                        <a class="btn btn-warning btn-options"
                                                                           data-toggle="tooltip" title="Valoración del producto"
                                                                           href="calificaciones.php?id=<?php echo $p->id ?>">
                                                                            <i class="fa fa-star"></i></a>
                                                                        <a class="btn btn-danger btn-options"
                                                                           data-toggle="modal"
                                                                           data-target="#eliminarModal"
                                                                           title="Eliminar producto"><i
                                                                                    class="fa fa-trash"></i></a>

                                                                        <a class="btn btn-info btn-options"
                                                                           data-toggle="tooltip" title="Editar producto"
                                                                           href="editProducto.php?id=<?php echo $p->id ?>">
                                                                            <i class="fas fa-pencil-alt"></i></a>
                                                                        <div class="modal fade" id="eliminarModal"
                                                                             tabindex="-1" role="dialog"
                                                                             aria-labelledby="eliminarModalLabel"
                                                                             aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title text-danger"
                                                                                            id="exampleModalLabel">
                                                                                            Eliminar Producto</h5>
                                                                                        <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Esta seguro de eliminar el
                                                                                        producto?
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">
                                                                                            Close
                                                                                        </button>
                                                                                        <a class="btn btn-danger btn-options"
                                                                                           data-toggle="tooltip"
                                                                                           title="Eliminar producto"
                                                                                           href="articulos.php?id=<?php echo $p->id ?>"><i
                                                                                                    class="fa fa-trash"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                        }else{ ?>
                                                            <tr><td colspan="8" align="center">No hay productos</td></tr>
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