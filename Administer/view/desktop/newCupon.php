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
        $descuento= isset($_POST['descuento']) ? $_POST['descuento'] : '';
        $cantidad= isset($_POST['cantidad']) ? $_POST['cantidad'] : '';
        $fecha = date('Y') . "-" . date('m') . "-" . date('d');
        if (empty($descuento or empty($cantidad)) ){
            $param=[
                    'ms'=>'Llene todos los campos con asterísco (obligatorio)',
                    'clase'=>'alert-danger',
                    'alert'=>'Error'
                    ];
        }else {
            $cupon = new Cupon(new Conexion());
            $user=new User(new Conexion());

            for($i=1;$i<=$cantidad;$i++) {
                $cupo = $user->gPass();
                $existe=$cupon->getExiste($cupo['pass']);
                if($existe=='no') {
                    $cupon->setCupon($cupo['pass']);
                    $cupon->setDescuento($descuento);
                    $cupon->setFecha($fecha);
                    $resul = $cupon->save();
                }
            }
            $param=[
                'ms'=>'Cupones generados',
                'clase'=>'alert-success',
                'alert'=>'Exito'
            ];

            header('Location: Cupones.php');

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
                                    <li class="breadcrumb-item active">Generar cupones </li>

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
                                            <a href="cupones.php" class="btn btn-primary pull-right cursor-pointer mr-1" >Finalizar</a>
                                        </div>
                                    <?php }?>
                                    <div class="card-body ">
                                        <form id="loginForm" action="newCupon.php" method="POST"  class="form-horizontal" >
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-label">*Cantidad de cupones a generar</span></label>
                                                        <input class="form-control" type="text" name="cantidad" placeholder="cantidad">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-label">*Descuento</span></label>
                                                        <input class="form-control" type="text" name="descuento" placeholder="% de descuento">
                                                    </div>
                                                </div>

                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary btn-lg pull-right cursor-pointer" ><i class="fas fa-save"></i> Generar</button>
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