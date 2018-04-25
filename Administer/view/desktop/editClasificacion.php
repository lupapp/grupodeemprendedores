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
        $clas = new Clasificacion($con);
        $ic=new Icono($con);
        $iconos=$ic->getAll();
        $ds = DIRECTORY_SEPARATOR;  //1

        $storeFolder = '../../public/img';   //2

        /*if (!empty($_FILES)) {

            $tempFile = $_FILES['file']['tmp_name'];          //3

            $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

            $targetFile =  $targetPath. $_FILES['file']['name'];  //5

            move_uploaded_file($tempFile,$targetFile); //6

            $con=1;
            foreach ($_FILES as $file){
                $imagen->setImagen($file['name']);
                $imagen->setProducto($_GET['id']);
                $imagen->setPocision($con);
                $save=$imagen->save();
                $con++;
            }

        }*/
        if(isset($_POST['delete'])){
            $id=$_POST["id"];
            $b= $imagen->delete($id);
            $ruta=$_POST['ruta'];
            unlink($ruta);
        }
        $param=['clase'=>'hidden'];
        if(isset($_POST['submit'])) {
            $nombre= isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $porcentaje= isset($_POST['porcentaje']) ? $_POST['porcentaje'] : '';
            $icono= isset($_POST['icono']) ? $_POST['icono'] : '';
            $min= isset($_POST['min']) ? $_POST['min'] : '';
            $max= isset($_POST['max']) ? $_POST['max'] : 0;
            if (empty($nombre) or empty($icono) or empty($min)){
                $param=[
                    'ms'=>'Llene todos los campos con asterísco (obligatorio)',
                    'clase'=>'alert-danger',
                    'alert'=>'Error'
                ];
                //header('Location: newClasificacion.php?ms='.$param["ms"].'&clase='.$param["clase"].'&alert='.$param["alert"].'');
            }else {
                $clas = new Clasificacion(new Conexion());
                $clas->setNombre($nombre);
                $clas->setPorcentaje($porcentaje);
                $clas->setIcono($icono);
                $clas->setMin($min);
                $clas->setMax($max);
                $resul = $clas->update($_GET['id']);
                $param = [
                    'ms' => 'Clasificación actualizada exitosamente',
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
                                    <li class="breadcrumb-item active">Editar categoría </li>

                                </ol>

                                <!-- Example DataTables Card-->
                                <div class="card mb-3 mt-1">
                                    <?php
                                    if (!isset($param)){}else{?>

                                        <div class="alert <?php echo $param['clase']; ?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong><?php echo $param['alert'].":"; ?></strong> <?php echo $param['ms'] ?>
                                            <a href="categorias.php" class="btn btn-primary pull-right cursor-pointer mr-1" >Finalizar</a>
                                        </div>
                                    <?php } ?>
                                    <div class="card-body ">


                                        <?php
                                        $clasi=$clas->getById($_GET['id']);
                                        ?>
                                        <form id="loginForm" action="editClasificacion.php?id=<?php echo $_GET['id'] ?>" method="POST"  class="form-horizontal" >
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group iconos">
                                                        <label><span class="text-label">*Icono</span><small> Seleccione un icono para la clasificación</small></label><br/>
                                                        <input type="radio" class="iconoAct hidden" name="icono" value="<?php echo $clasi->icono ?>" checked>
                                                        <?php for($i=0; $i<count($iconos);$i++){?>
                                                            <label class="checkbox-inline labelIcono"><input type="radio" name="icono" class="hidden" value="<?php echo $iconos[$i]->icon ?>"><h3 class="icono"><i class="<?php echo $iconos[$i]->icon ?>" ></i> </h3></label>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">*Clasificación</span></label>
                                                        <input class="form-control" type="text" name="nombre" placeholder="Clasificación" value="<?php echo $clasi->nombre ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">Porcentaje de descuento</span></label>
                                                        <input class="form-control" type="text" name="porcentaje" placeholder="Porcentaje de descuento" value="<?php echo $clasi->porcentaje ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">*Mínimo de personas</span></label>
                                                        <input class="form-control" type="text" name="min" placeholder="Mínimo de personas" value="<?php echo $clasi->min ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <div class="form-group">
                                                        <label><span class="text-label">Máximo de personas</span></label>
                                                        <input class="form-control" type="text" name="max" placeholder="Máximo de personas" value="<?php echo $clasi->max ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-md-offset-3">

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