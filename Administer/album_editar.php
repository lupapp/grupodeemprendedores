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
		$varimagen = "ALBUM-".$codigounico.$_FILES['ima']['name'];
		}
				
  $updateSQL = sprintf("UPDATE tbl_album SET titulo=%s, code=%s, contenido=%s, imagen=%s, estado=%s, vincular=%s, categoria=%s WHERE id=%s",
                       GetSQLValueString($_POST['titulo'], "text"),
					   GetSQLValueString($_POST['seo'], "text"),
                       GetSQLValueString($_POST['contenido'], "text"),
                       GetSQLValueString($varimagen, "text"),
					   GetSQLValueString($_POST['estado'], "text"),
					   GetSQLValueString($_POST['vincular'], "text"),
					   GetSQLValueString($_POST['categoria'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
  
  
  if($_FILES['ima']['name']!= ""){
		copy($_FILES['ima']['tmp_name'],"../public/ALBUM-".$codigounico.$_FILES['ima']['name']); 
		 $dim = getimagesize("../public/ALBUM-".$codigounico.$_FILES['ima']['name']);
		 
		 if($dim[0]>=500){
				
				
  						$thumb1=new thumbnail("../public/ALBUM-".$codigounico.$_FILES['ima']['name']); 
					    $thumb1->size_width(500);
					    $thumb1->jpeg_quality(90);
					    $thumb1->save("../public/ALBUM-".$codigounico.$_FILES['ima']['name']);
				
		 }
 	}

  mysql_select_db($database_admin, $admin);
  $Result1 = mysql_query($updateSQL, $admin) or die(mysql_error());

  $updateGoTo = "album.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_editar = "-1";
if (isset($_GET['id'])) {
  $colname_editar = $_GET['id'];
}
mysql_select_db($database_admin, $admin);
$query_editar = sprintf("SELECT * FROM tbl_album WHERE id = %s", GetSQLValueString($colname_editar, "int"));
$editar = mysql_query($query_editar, $admin) or die(mysql_error());
$row_editar = mysql_fetch_assoc($editar);
$totalRows_editar = mysql_num_rows($editar);

mysql_select_db($database_admin, $admin);
$query_categorias = "SELECT * FROM tbl_album_categorias ORDER BY nombre ASC";
$categorias = mysql_query($query_categorias, $admin) or die(mysql_error());
$row_categorias = mysql_fetch_assoc($categorias);
$totalRows_categorias = mysql_num_rows($categorias);

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
														
								<h2 class="panel-title">Editar Album</h2>
							</header>
                            <form id="form" class="form-horizontal form-bordered" action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data">
							<div class="panel-body">
                            	<div style="margin-bottom:10px;">
									<a href="album.php" class="mb-xs mt-xs mr-xs btn btn-default"><li class="fa fa-arrow-circle-o-left"></li> Regresar</a>
									
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
												<label class="col-md-3 control-label" for="inputSuccess">Categoria</label>
												<div class="col-md-6">
													<select class="form-control mb-md" name="categoria">
														<?php do{ ?>
                                                        <option value="<?php echo $row_categorias['id']; ?>" <?php if($row_categorias['id']==$row_editar['categoria']){ echo " selected"; } ?>><?php echo $row_categorias['nombre']; ?></option>
														<?php } while ($row_categorias = mysql_fetch_assoc($categorias)); ?>
														
													</select>
						
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Titulo</label>
												<div class="col-md-6">
													<input name="titulo" type="text" class="form-control" id="titulo" title="Ingresa el titulo del banner."  required value="<?php echo $row_editar['titulo']; ?>">
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">SEO URL</label>
												<div class="col-md-6">
													<input name="seo" type="text" class="form-control" id="seo" title="Ingresa contenido URL."  required value="<?php echo $row_editar['code']; ?>">
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
                                                    <span class="help-block">Tamaño de imagen: 500 Px Ancho mínimo</span>
												</div>
											</div>
						
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Estado del Album</label>
												<div class="col-md-6">
													<select class="form-control mb-md" name="estado">
														<option value="1" <?php if($row_editar['estado']=="1"){ echo "selected"; } ?> >Activo</option>
														<option value="0" <?php if($row_editar['estado']=="0"){ echo "selected"; } ?> >Suspendido</option>
														
													</select>
						
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Vincular a Entrada</label>
												<div class="col-md-6">
													<select class="form-control mb-md" name="vincular">
														<option value="0" <?php if($row_editar['vincular']=="0"){ echo "selected"; } ?> >No</option>
                                                        <option value="1" <?php if($row_editar['vincular']=="1"){ echo "selected"; } ?> >Si</option>
													</select>
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