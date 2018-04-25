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
    $pedido = new Pedido($con);
    $pe=$pedido->getById($_GET['id']);
    $user=new User($con);
    $linea=new LineaPedido($con);
    if(isset($_POST['submit'])) {
        $id = $_GET['id'];
        $estado= isset($_POST['estado']) ? $_POST['estado'] : '';

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
                                    <li class="breadcrumb-item active">Pedido </li>

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
                                            <div class="col-md-4">

                                                <form action="../../controller/cambioEstado.php" method="post">
                                                    <?php switch($pe->estado){
                                                        case 0:$estado='Pendiente'; $bg='bg-danger';
                                                        break;
                                                        case 1:$estado='Despachado'; $bg='bg-success';
                                                            break;
                                                        case 2:$estado='Anulado'; $bg='bg-warning';
                                                            break;
                                                    }?>
                                                    <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                                                    <input type="hidden" name="edit" value="si">
                                                    <select name="estado">
                                                        <option value="1" class="<?php echo $bg ?>">Despachado</option>
                                                        <option value="0" class="<?php echo $bg ?>">Pendiente</option>
                                                        <option value="2" class="<?php echo $bg ?>">Anulado</option>
                                                    </select>
                                                    <button class="btn btn-info " name="reset"><i class="fas fa-redo"></i> Cambiar estado</button>

                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-md-offset-8 col-md-4 ">

                                            <div class="breadcrumb border-1 ">
                                                <strong>No. Pedido:</strong> <?php echo $pe->id ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="breadcrumb border-1">
                                                <strong>Fecha:</strong> <?php echo $pe->fecha ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="breadcrumb border-1">
                                                <strong>Hora:</strong> <?php echo $pe->hora ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="breadcrumb border-1">
                                                <strong>Forma de pago:</strong> <?php echo $pe->metodoPago ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="breadcrumb border-1 <?php echo $bg ?>">
                                                <strong>Esatodo:</strong> <?php echo $estado ?>
                                            </div>
                                        </div>
                                        <?php $usu=$user->getById($pe->cliente); ?>
                                            <div class="col-md-6">
                                                <div class="breadcrumb border-1">
                                                    <strong>Nombre del Cliente:</strong> <?php echo $usu->nombre ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="breadcrumb border-1">
                                                    <strong>Teléfono:</strong> <?php echo $usu->telefono ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="breadcrumb border-1">
                                                    <strong>Celular:</strong> <?php echo $usu->movil ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="breadcrumb border-1">
                                                    <strong>Dirección:</strong> <?php echo $usu->direccion." ".$usu->ciudad ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="breadcrumb border-1">
                                                    <strong>Correo electrónico:</strong> <?php echo $usu->mail ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="breadcrumb border-1">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Ref</th>
                                                            <th>Descripción</th>
                                                            <th>Cantidad</th>
                                                            <th>Valor unitario</th>
                                                            <th>Valor total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $lin=$linea->getByIdPedido($pe->id);
                                                        foreach ($lin as $l){?>
                                                        <tr>
                                                            <td><?php echo $l->idPro ?></td>
                                                            <td><!--<img src="../../public/img/<?php echo $l->img ?>"class="img-thumbnail"> --><?php echo $l->nomPro ?></td>
                                                            <td><?php echo $l->cantidad?></td>
                                                            <td><?php echo $l->valorPro ?></td>
                                                            <td><?php echo $l->totalLinea ?></td>
                                                        </tr>
                                                        <?php }?>
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th colspan="4" align="right">TOTAL PEDIDO</th>
                                                            <th>$ <?php echo $pe->total ?></th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
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
        <script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
        <script src="../../assets/js/dropzone.js"></script>




	</body>
</html>