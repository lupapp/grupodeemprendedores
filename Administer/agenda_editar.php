<?php include("restringir.php"); ?>
<?php include("acentos.php"); ?>
<?php include("funciones.php"); ?>
<?php

$editFormAction = $_SERorden['PHP_SELF'];
if (isset($_SERorden['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERorden['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	$codigounico = date("ymd-His");
	
	if($_FILES['ima']['name']==""){
		$varimagen = $_POST['imagen'];
	} else {
		$varimagen = "AGENDA-".$codigounico.$_FILES['ima']['name'];
		}

	$fecha1 = $_POST['fecha1']." ".$_POST['hora1'];
	
	if($_POST['fecha2']!=""){ $fecha2 = $_POST['fecha2']." ".$_POST['hora2']; } else { $fecha2 = ""; }
				
  $updateSQL = sprintf("UPDATE tbl_agenda SET titulo=%s, contenido=%s, imagen=%s, start=%s, end=%s, allday=%s, color=%s, url=%s, entrada=%s WHERE id=%s",
                       GetSQLValueString($_POST['titulo'], "text"),
					   GetSQLValueString($_POST['contenido'], "text"),
					   GetSQLValueString($varimagen, "text"),
					   GetSQLValueString($fecha1, "date"),
					   GetSQLValueString($fecha2, "date"),
					   GetSQLValueString($_POST['allday'], "text"),
					   GetSQLValueString($_POST['color'], "text"),
					   GetSQLValueString($_POST['url'], "text"),
					   GetSQLValueString($_POST['entrada'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
  
  if($_FILES['ima']['name']!= ""){
		copy($_FILES['ima']['tmp_name'],"../public/AGENDA-".$codigounico.$_FILES['ima']['name']); 
		 $dim = getimagesize("../public/AGENDA-".$codigounico.$_FILES['ima']['name']);
		 
		 if($dim[0]>=500){
				
				
  						$thumb1=new thumbnail("../public/AGENDA-".$codigounico.$_FILES['ima']['name']); 
					    $thumb1->size_width(500);
					    $thumb1->jpeg_quality(90);
					    $thumb1->save("../public/AGENDA-".$codigounico.$_FILES['ima']['name']);
				
		 }
 	}
	
 mysql_select_db($database_admin, $admin);
  $Result1 = mysql_query($updateSQL, $admin) or die(mysql_error());

  $updateGoTo = "agenda.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));

}

mysql_select_db($database_admin, $admin);
$query_entradas = "SELECT * FROM tbl_post WHERE categoria = '2' ORDER BY titulo ASC";
$entradas = mysql_query($query_entradas, $admin) or die(mysql_error());
$row_entradas = mysql_fetch_assoc($entradas);
$totalRows_entradas = mysql_num_rows($entradas);

mysql_select_db($database_admin, $admin);
$query_editar = "SELECT * FROM tbl_agenda WHERE id = '".$_GET['id']."'";
$editar = mysql_query($query_editar, $admin) or die(mysql_error());
$row_editar = mysql_fetch_assoc($editar);
$totalRows_editar = mysql_num_rows($editar);

?>
<!doctype html>
<html class="fixed">
	<head>

	<?php include("llamadoshead.php"); ?>
	<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />	
	<script type="text/javascript">
	function fAgrega()
	{
		var ltr = ['[àáâãä]','[èéêë]','[ìíîï]','[òóôõö]','[ùúûü]','ñ','ç','[ýÿ]','\\s|\\W|_'];
		var rpl = ['a','e','i','o','u','n','c','y','-'];
		var str = String(document.getElementById("titulo").value.toLowerCase());
		var fechahoy = "<?php echo date("Y-m-"); ?>";
			
		for (var i = 0, c = ltr.length; i < c; i++)
		{
			var rgx = new RegExp(ltr[i],'g');
			str = str.replace(rgx,rpl[i]);
		};
		
	   document.getElementById("seo").value = fechahoy + str;
	}
	</script>
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
						<h2>Agenda</h2>
					
					</header>

						<section class="panel">
							<header class="panel-heading">
														
								<h2 class="panel-title">Editar Agenda</h2>
							</header>
                            <form id="form" class="form-horizontal form-bordered" action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data">
							<div class="panel-body">
                            	<div style="margin-bottom:10px;">
									<a href="agenda.php" class="mb-xs mt-xs mr-xs btn btn-default"><li class="fa fa-arrow-circle-o-left"></li> Regresar</a>
                                    <a  class="mb-xs mt-xs mr-xs btn btn-danger modal-basic" href="#modalPrimary<?php echo $_GET['id']; ?>">Eliminar Registro</a>
									<div id="modalPrimary<?php echo $_GET['id']; ?>" class="modal-block modal-block-primary mfp-hide">
                                                        <section class="panel">
                                                            <header class="panel-heading">
                                                                <h2 class="panel-title">Alerta</h2>
                                                            </header>
                                                            <div class="panel-body">
                                                                <div class="modal-wrapper">
                                                                    <div class="modal-icon">
                                                                        <i class="fa fa-question-circle"></i>
                                                                    </div>
                                                                    <div class="modal-text">
                                                                       
                                                                        <p>Estas seguro de eliminar este elemento?</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <footer class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-md-12 text-right">
                                                                        <a class="btn btn-primary modal-confirm" href="agenda_eliminar.php?id=<?php echo $_GET['id']; ?>">Confirmar</a>
                                                                        <a class="btn btn-default modal-dismiss">Cancelar</a>
                                                                    </div>
                                                                </div>
                                                            </footer>
                                                        </section>
                                                    </div>
								</div>
								<div>
											<div class="validation-message">
											<ul></ul>
											</div>
                                            
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Titulo</label>
												<div class="col-md-7">
													<input name="titulo" type="text" class="form-control" id="titulo" title="Ingresa el titulo de la entrada."  required value="<?php echo $row_editar['titulo']; ?>">
												</div>
											</div>
                                            						
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDisabled">Descripción</label>
												<div class="col-md-7">
													<textarea name="contenido" class="form-control" rows="3" id="contenido" data-plugin-textarea-autosize="" style="oordenflow: hidden; word-wrap: break-word; resize: none; height: 74px;" required title="Ingresa una breve descripcion." data-plugin-maxlength maxlength="300"><?php echo $row_editar['contenido']; ?></textarea>
												</div>
											</div>
                                            
                                            <?php if($row_editar['imagen']!=""){ ?>
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
                                            <?php } ?>
                                            
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
                                                    <span class="help-block">Tamaño de imagen: 500px Ancho mínimo</span>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">URL</label>
												<div class="col-md-7">
													<input name="url" type="text" class="form-control" id="url"  value="<?php echo $row_editar['url']; ?>">
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label">Inicia</label>
												<div class="col-md-3">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" name="fecha1" data-plugin-datepicker="" class="form-control" required title="Debes ingresar una fecha para la entrada." value="<?php $fechahoy = $row_editar["start"]; $fecha_actual = strtotime($fechahoy); echo date("Y-m-d", $fecha_actual); ?>">
													</div>
												</div>
                                                <div class="col-md-3">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-clock-o"></i>
														</span>
														<input type="text" name="hora1" data-plugin-timepicker="" class="form-control" data-plugin-options='{ "showMeridian": false }' value="<?php $fechahoy = $row_editar["start"]; $fecha_actual = strtotime($fechahoy); echo date("h:i", $fecha_actual); ?>">
													</div>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label">Finaliza</label>
												<div class="col-md-3">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" name="fecha2" data-plugin-datepicker="" class="form-control" value="<?php if($row_editar["end"]!=""){ $fechahoy = $row_editar["end"]; $fecha_actual = strtotime($fechahoy); echo date("Y-m-d", $fecha_actual); } ?>">
													</div>
												</div>
                                                <div class="col-md-3">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-clock-o"></i>
														</span>
														<input type="text" name="hora2" id="hora1" data-plugin-timepicker="" class="form-control" data-plugin-options='{ "showMeridian": false }' value="<?php if($row_editar["end"]!=""){  $fechahoy = $row_editar["end"]; $fecha_actual = strtotime($fechahoy); echo date("h:i", $fecha_actual); } else { echo "00:00"; } ?>">
													</div>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label">Color de Evento</label>
												<div class="col-md-6">
													<input type="text" name="color" id="color" data-plugin-colorpicker class="colorpicker-default form-control" required title="Debes seleccionar un color." value="<?php echo $row_editar['color']; ?>"/>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Vincular a entrada</label>
												<div class="col-md-6">
													<select class="form-control mb-md" name="categoria">
														<?php do{ ?>
                                                        <option value="<?php echo $row_entradas['id']; ?>" <?php if($row_entradas['id']==$row_editar['entrada']){ echo "selected"; } ?> ><?php echo $row_entradas['titulo']; ?></option>
														<?php } while ($row_entradas = mysql_fetch_assoc($entradas)); ?>
														
													</select>
						
												</div>
											</div>
						
											
											
										
										</div>
							</div>
                            <footer class="panel-footer">
										<div class="row">
											<div class="col-sm-9 col-sm-offset-2">
                                                <input type="submit" value="Editar Registro"  class="btn btn-primary"/>
												<button type="reset" class="btn btn-default">Borrar Formulario</button>
                                                
                                                <input type="hidden" name="MM_update" value="form1" />
                                                <input type="hidden" name="id" value="<?php echo $row_editar['id']; ?>" />
                                                <input name="imagen" type="hidden" id="imagen" value="<?php echo $row_editar['imagen']; ?>" />
											</div>
										</div>
							</footer>
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
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		
        <script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        <script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
        <script src="assets/vendor/pnotify/pnotify.custom.js"></script>
        
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/forms/examples.advanced.form.js" /></script>
		
        <script src="assets/javascripts/forms/examples.validation.js"></script>
        
        <script type="text/javascript">
		$(document).ready(function() {
			$('#summernote').summernote({
				minHeight: 200,
				codemirror: {
				  mode: 'text/html',
				  htmlMode: true,
				  lineNumbers: true,
				  theme: 'monokai'
				},
				onImageUpload: function(files, editor, welEditable) {
					sendFile(files[0], editor, welEditable);
				}
			});
			function sendFile(file, editor, welEditable) {
				data = new FormData();
				data.append("file", file);
				$.ajax({
					data: data,
					type: 'POST',
					xhr: function() {
						var myXhr = $.ajaxSettings.xhr();
						if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
						return myXhr;
					},
					url: 'savetheuploadedfile.php',
					cache: false,
					contentType: false,
					processData: false,
					success: function(url) {
						editor.insertImage(welEditable, url);
					}
				});
			}
		
			// update progress bar
		
			function progressHandlingFunction(e){
				if(e.lengthComputable){
					$('progress').attr({value:e.loaded, max:e.total});
					// reset progress on complete
					if (e.loaded == e.total) {
						$('progress').attr('value','0.0');
					}
				}
			}
			/*
			function sendFile(file, editor, welEditable) {
				data = new FormData();
				data.append("file", file);//You can append as many data as you want. Check mozilla docs for this
				$.ajax({
					data: data,
					type: "POST",
					url: 'savetheuploadedfile.php',
					cache: false,
					contentType: false,
					processData: false,
					success: function(url) {
						editor.insertImage(welEditable, url);
					}
				});
			}*/
		});
		</script>
		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>

	</body>
</html>