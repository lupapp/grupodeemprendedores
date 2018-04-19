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

        $options = new Options(new Conexion());
        $param=['clase'=>'hidden'];
        if(isset($_POST['submit'])) {
            $nombre= isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $valor= isset($_POST['valor']) ? $_POST['valor'] : '';
            $borrar= isset($_POST['borrar']) ? $_POST['borrar'] : '';
            $estado= isset($_POST['estado']) ? $_POST['estado'] : '';
            if (empty($nombre) or empty($valor) or empty($borrar) or empty($estado)) {
                $param = [
                    'ms' => 'Llene todos los campos con asterísco (obligatorio)',
                    'clase' => 'alert-danger',
                    'alert' => 'Error'
                ];
            } else {
                $options->setName($nombre);
                $options->setValor($valor);
                $options->setBorrar($borrar);
                $options->setEstado($estado);
                $resul = $options->update($_GET['id']);
                $param = [
                    'ms' => 'Ajuste actualizado exitosamente',
                    'clase' => 'alert-success',
                    'alert' => 'Exito'
                ];
            }
        }
    ?>
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
                                    <li class="breadcrumb-item active">Editar Ajuste </li>

                                </ol>

                                <!-- Example DataTables Card-->
                                <div class="card mb-3 mt-1">
                                    <?php
                                    if (!isset($param)){}else{?>

                                        <div class="alert <?php echo $param['clase'] ?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong><?php echo $param['alert'].":"; ?></strong> <?php echo $param['ms'] ?>
                                            <a href="categorias.php" class="btn btn-primary pull-right cursor-pointer mr-1" >Finalizar</a>
                                        </div>
                                    <?php } ?>
                                    <div class="card-body ">


                                        <?php
                                        $opt=$options->getById($_GET['id']);
                                        ?>
                                        <form id="loginForm" action="editAjuste.php?id=<?php echo $_GET['id'] ?>" method="POST"  class="form-horizontal" >
                                            <div class="form-row">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">*Nombre</span></label>
                                                        <input class="form-control" type="hidden" name="nombre" value="<?php echo $opt->name ?>">
                                                        <input class="form-control" type="text" value="<?php echo $opt->name ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">*Valor</span></label>
                                                        <input class="form-control" type="text" name="valor" value="<?php echo $opt->valor ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">Se puede borrar</span></label>
                                                        <select class="form-control" name="borrar" id="exampleFormControlSelect1">
                                                            <option value="<?php echo $opt->borrar ?>"><?php echo $opt->borrar ?></option>
                                                            <option value="no">No</option>
                                                            <option value="si">Si</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">Estado</span></label>
                                                        <select class="form-control" name="estado" id="exampleFormControlSelect1">
                                                            <option value="<?php echo $opt->estado ?>"><?php echo $opt->estado ?></option>
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary pull-right cursor-pointer" ><i class="fas fa-save"></i> Guardar</button>
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
        <script src="../../assets/js/dropzone.js"></script>
        <script>
            $(document).ready(function (){
                $('#guardarImagenes').click(function() {
                    var myDropzone = Dropzone.forElement(".dropzone");
                    myDropzone.processQueue();
                });

                Dropzone.options.myDropzone = {
                    dictDefaultMessage: "Arrastre o de click aqui para subir las imagenes.",
                    addRemoveLinks: true,
                    autoProcessQueue:false,
                    init: function() {
                        thisDropzone = this;
                        /* ESTE CODIGO SIRVE PARA MOSTRAR LOS ARCHIVOS ACTUALES EN EL SERVIDOR*/
                        $.get('', function(data) {

                            $.each(data, function(key,value){
                                var mockFile = { name: value.name, size: value.size};
                                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "../../public/img/"+value.name);
                                thisDropzone.emit("complete", mockFile);
                                var ext = mockFile.name.split(".")[1];
                                switch(ext){
                                    case "xls":
                                        thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/excel.png');
                                        break;
                                    case "xlsx":
                                        thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/excel.png');
                                        break;
                                    case "pdf":
                                        thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/pdf.png');
                                        break;
                                    case "doc":
                                        thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/doc.png');
                                    case "docx":
                                        thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/doc.png');
                                        break;
                                    case "zip":
                                        thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/zip.png');
                                        break;
                                    case "rar":
                                        thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/rar.png');
                                        break;
                                    case "ppt":
                                        thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/ppt.png');
                                        break;
                                    case "pptx":
                                        thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/ppt.png');
                                        break;
                                    case "png":
                                        break;
                                    case "jpg":
                                        break;
                                    case "jpeg":
                                        break;
                                    default:
                                        thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/nose.png');
                                        break;
                                }
                            });
                        });
                    },
                    /* EL EVENTO ACCEPT NOS PERMITE CAMBIAR LA IMAGEN DE VISTA PREVIA QUE SE MUESTRA */
                    accept: function(file, done) {
                        var thumbnail = $('.dropzone .dz-preview.dz-file-preview .dz-image:last');

                        switch (file.type) {
                            case 'application/pdf':
                                thumbnail.css('background', 'url(dist/img/pdf.png');
                                break;
                            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                                thumbnail.css('background', 'url(dist/img/doc.png');
                                break;
                            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                                thumbnail.css('background', 'url(dist/img/excel.png');
                                break;
                            case 'application/vnd.ms-excel':
                                thumbnail.css('background', 'url(dist/img/excel.png');
                                break;
                            case 'application/zip, application/x-compressed-zip':
                                thumbnail.css('background', 'url(dist/img/zip.png');
                                break;
                            case 'application/vnd.ms-powerpointtd>':
                                thumbnail.css('background', 'url(dist/img/ppt.png');
                                break;
                            case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
                                thumbnail.css('background', 'url(dist/img/ppt.png');
                                break;
                            case 'image/jpeg':
                                break;
                            case 'image/png':
                                break;
                            default:
                                thumbnail.css('background', 'url(dist/img/nose.png');
                        }

                        done();
                    },
                    /* ESTE EVENTO NOS PERMITE ELIMINAR REALMENTE EL ARCHIVO DEL SERVIDOR */
                    removedfile: function(file) {
                        $.get( "eliminarArchivo.php", {
                            nombre: file.name
                        }).done(function( data ) {
                            var _ref;
                            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                        });
                    }
                };

            });
        </script>
        <script>
            CKEDITOR.replace('deslarga');
            CKEDITOR.replace('descorta',
                {
                    height:70
                });
        </script>


	</body>
</html>