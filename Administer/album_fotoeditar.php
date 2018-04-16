<?php include("restringir.php"); ?>
<?php include("acentos.php"); ?>
<?php include("funciones.php"); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	$codigounico = date("ymd-His");
	
	if($_FILES['ima']['name']==""){
		$varimagen = $_POST['imagen'];
	} else {
		$varimagen = "FOTO-".$codigounico.$_FILES['ima']['name'];
		}
				
  $updateSQL = sprintf("UPDATE tbl_fotos SET titulo=%s, contenido=%s, imagen=%s  WHERE id=%s",
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['contenido'], "text"),
                       GetSQLValueString($varimagen, "text"),
                       GetSQLValueString($_POST['id'], "int"));
  
  
  if($_FILES['ima']['name']!= ""){
		copy($_FILES['ima']['tmp_name'],"../public/FOTO-".$codigounico.$_FILES['ima']['name']); 
		 $dim = getimagesize("../public/FOTO-".$codigounico.$_FILES['ima']['name']);
		 
		 if($dim[0]>=800){
				
				
  						$thumb1=new thumbnail("../public/FOTO-".$codigounico.$_FILES['ima']['name']); 
					    $thumb1->size_width(800);
					    $thumb1->jpeg_quality(90);
					    $thumb1->save("../public/FOTO-".$codigounico.$_FILES['ima']['name']);
				
		 }
 	}

  mysql_select_db($database_admin, $admin);
  $Result1 = mysql_query($updateSQL, $admin) or die(mysql_error());

  $updateGoTo = "album_fotos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_editar = "-1";
if (isset($_GET['ob'])) {
  $colname_editar = $_GET['ob'];
}
mysql_select_db($database_admin, $admin);
$query_editar = sprintf("SELECT * FROM tbl_fotos WHERE id = %s", GetSQLValueString($colname_editar, "int"));
$editar = mysql_query($query_editar, $admin) or die(mysql_error());
$row_editar = mysql_fetch_assoc($editar);
$totalRows_editar = mysql_num_rows($editar);

?>
<!doctype html>
<html class="fixed">
	<head>

	<?php include("llamadoshead.php"); ?>
		

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<?php include("header.php"); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include("nav.php");?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Galería Fotográfica</h2>
					
					</header>

						<section class="panel">
							<header class="panel-heading">
														
								<h2 class="panel-title">Editar Foto</h2>
							</header>
                            <form id="form" class="form-horizontal form-bordered" action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data">
							<div class="panel-body">
                            	<div style="margin-bottom:10px;">
									<a href="album_fotos.php?id=<?php echo $_GET['id']; ?>" class="mb-xs mt-xs mr-xs btn btn-default"><li class="fa fa-arrow-circle-o-left"></li> Regresar</a>
									
								</div>
								<div>
											<div class="validation-message">
											<ul></ul>
											</div>
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Imagen Actual</label>
												<div class="col-md-6">
													<div class="post-image">
												<div class="img-thumbnail">
													
														<a><img src="../public/<?php echo $row_editar['imagen']; ?>" alt="" width="300"></a>
													
												</div>
											</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Titulo</label>
												<div class="col-md-6">
													<input name="titulo" type="text" class="form-control" id="titulo" title="Ingresa el titulo del banner."  required value="<?php echo $row_editar['titulo']; ?>">
												</div>
											</div>
						
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDisabled">Contenido</label>
												<div class="col-md-6">
													<textarea name="contenido" class="form-control" rows="3" id="contenido" data-plugin-textarea-autosize="" style="oordenflow: hidden; word-wrap: break-word; resize: none; height: 74px;"><?php echo $row_editar['contenido']; ?></textarea>
												</div>
											</div>
						
											<div class="form-group">
												<label class="col-md-3 control-label" >Imagen</label>
												<div class="col-md-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Cambiar</span>
																<span class="fileupload-new">Seleccionar Archivo</span>
																<input name="ima" type="file" />
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
														</div>
													</div>
                                                    <span class="help-block">Tamaño de imagen: 800 Px Ancho mínimo</span>
												</div>
											</div>
						
											
										
										</div>
							</div>
                            <footer class="panel-footer">
										<div class="row">
											<div class="col-sm-9 col-sm-offset-3">
                                            	<input type="hidden" name="MM_insert" value="form1" />
                                                <input type="submit" value="Editar Registro"  class="btn btn-primary"/>
											</div>
										</div>
							</footer>
							<input type="hidden" name="MM_update" value="form1" />
							<input type="hidden" name="id" value="<?php echo $row_editar['id']; ?>" />
                            <input name="imagen" type="hidden" id="imagen" value="<?php echo $row_editar['imagen']; ?>" />
                            </form>
						</section>
					<!-- end: page -->
				</section>
			</div>

			
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        <script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		
        <script src="assets/javascripts/forms/examples.validation.js"></script>


	</body>
</html>