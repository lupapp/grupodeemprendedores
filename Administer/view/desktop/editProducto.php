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
        $producto = new Producto($con);
        $imagen=new Imagen($con);
        $categoria=new Categoria($con);
        $clasificacion=new Clasificacion($con);
        $cat=$categoria->getAll();
        $clas=$clasificacion->getAll();
        $ds = DIRECTORY_SEPARATOR;  //1

        $storeFolder = '../../public/img';   //2

        if (!empty($_FILES)) {

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

        }
        if(isset($_POST['delete'])){
            $id=$_POST["id"];
            $b= $imagen->delete($id);
            $ruta=$_POST['ruta'];
            unlink($ruta);
        }
    $param=['clase'=>'hidden'];
    if(isset($_POST['submit'])){
        $name= isset($_POST['name']) ? $_POST['name'] : '';
        $valor= isset($_POST['valor']) ? $_POST['valor'] : '';
        $descripcion= isset($_POST['descorta']) ? $_POST['descorta'] : '';
        $detalle=isset($_POST['deslarga']) ? $_POST['deslarga'] : '';
        if (empty($name) or empty($valor) or empty($descripcion)){
            $param=[
                    'ms'=>'Llene todos los campos con asterísco (obligatorio)',
                    'clase'=>'alert-danger',
                    'alert'=>'Error'
                    ];
            header('Location: newProducto.php?ms='.$param["ms"].'&clase='.$param["clase"].'&alert='.$param["alert"].'');
        }else {
            $labelEsp=$_POST['especificacion'];
            $valEsp=$_POST['valEsp'];
            $esp=array();
            for($i=0;$i<count($labelEsp);$i++){
                $e=array(
                    'especificacion'=>$labelEsp[$i],
                    'valor'=>$valEsp[$i]
                );
                array_push($esp, $e);
            }

            $espJason=json_encode($esp,JSON_FORCE_OBJECT);
            $producto->setName($name);
            $producto->setValor($valor);
            $producto->setDescripcion($descripcion);
            $producto->setDetalle($detalle);
            $producto->setCategoria($_POST['idCat']);
            $producto->setEsp($espJason);
            $producto->setStock($_POST['stock']);
            $resul = $producto->update($_GET['id']);
            $param=[
                'ms'=>'Producto actualizado exitosamente',
                'clase'=>'alert-success',
                'alert'=>'Exito'
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
                                    <li class="breadcrumb-item active">Nuevo Producto </li>

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
                                            <div class="col-md-6">
                                                <h4>Imagenes actuales</h4>
                                                <div class="imgProd">
                                                    <?php
                                                    $img=$imagen->getByProd($_GET['id']);
                                                    foreach ($img as $im){
                                                    ?>
                                                    <div class="img-thumbnail w-30" id="img<?php echo $im->id ?>">
                                                        <img  class="w-100" id="et-img<?php echo $im->id ?>" src="../../public/img/<?php echo $im->imagen ?>"/>
                                                        <a class="deleteImg cursor-pointer" data-id="<?php echo $im->id ?>">Eliminar</a>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>Subir imagenes</h4>
                                                <div id="dropzone">
                                                    <form action="editProducto.php?id=<?php echo $_GET['id'] ?>" class="dropzone" id="my-dropzone" method="post">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <a class="btn btn-info pull-right" id="guardarImagenes"><i class="fas fa-save"></i> Guardar</a>
                                            </div>
                                        </div>
                                        <?php
                                        $prod=$producto->getById($_GET['id']);
                                        ?>
                                        <form id="loginForm" action="editProducto.php?id=<?php echo $_GET['id'] ?>" method="POST"  class="form-horizontal" >
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputUser"><span class="text-label">*Nombre del producto</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="name" aria-describedby="usuario" value="<?php echo $prod->name ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><span class="text-label">Categoría</span></label>
                                                        <select class="form-control" name="idCat" id="exampleFormControlSelect1">
                                                            <?php
                                                            $c=$categoria->getById($prod->categoria); ?>
                                                            <option value="<?php echo $c->id?>"><?php echo $c->nombre ?></option>
                                                            <?php foreach ($cat as $a){?>
                                                                <option value="<?php echo $a->id ?>"><?php echo $a->nombre ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputUser"><span class="text-label">*Stock</span></label>
                                                        <input class="form-control" type="text" name="stock" placeholder="Stock" value="<?php echo $prod->stock ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputName"><span class="text-label">*Valor</span></label>
                                                        <input class="form-control" id="exampleInputUser" type="text" name="valor" aria-describedby="usuario" value="<?php echo $prod->valor ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-7">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label><span class="text-label">Especificaciones </span></label>

                                                            <span class="mb-1"> Puede añadir campos de especificaciones</span>

                                                            <div class="row">
                                                                <?php $esp =json_decode($prod->esp, true);
                                                                $con=1;
                                                                if(count($esp)==0){ ?>
                                                                      <div class="col-md-10">

                                                                            <div id="Add<?php echo $con ?>"
                                                                                 class="clonedInput">
                                                                                <input class="form-control float-left w-50"
                                                                                       type="text"
                                                                                       name="especificacion[]"
                                                                                       id="name1"
                                                                                       placeholder="Especificación"/>
                                                                                <input class="form-control float-left w-50"
                                                                                       type="text" name="valEsp[]"
                                                                                       id="name1"
                                                                                       placeholder="Fecha, Autor, etc"/>
                                                                            </div>


                                                                            <?php if (count($esp) < 10) { ?>

                                                                            <?php } ?>
                                                            </div>
                                                                <?php }else {
                                                                    foreach ($esp as $e) {
                                                                        ?>
                                                                        <div class="col-md-10">

                                                                            <div id="Add<?php echo $con ?>"
                                                                                 class="clonedInput">
                                                                                <input class="form-control float-left w-50"
                                                                                       type="text"
                                                                                       name="especificacion[]"
                                                                                       id="name1"
                                                                                       value="<?php echo $e['especificacion'] ?>"/>
                                                                                <input class="form-control float-left w-50"
                                                                                       type="text" name="valEsp[]"
                                                                                       id="name1"
                                                                                       value="<?php echo $e['valor'] ?>"/>
                                                                            </div>


                                                                            <?php if (count($esp) < 10) { ?>

                                                                            <?php } ?>
                                                                        </div>
                                                                        <?php
                                                                        $con++;
                                                                    }
                                                                }?>
                                                                <div class="col-md-2">
                                                                <?php if (count($esp) < 10) { ?>
                                                                    <div class="btn-group pull-left">
                                                                        <a class="btn btn-success btn-xs btn-options"
                                                                           id="btnAdd" data-toggle="tooltip"
                                                                           title="Añadir campo"><i
                                                                                    class="fas fa-plus"></i></a>
                                                                        <a class="btn btn-default btn-xs btn-options"
                                                                           id="btnDel" data-toggle="tooltip"
                                                                           title="Quitar campo"><i
                                                                                    class="fas fa-trash"></i></a>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="btn-group pull-left">
                                                                        <a class="btn btn-default btn-xs btn-options"
                                                                           id="btnDel" data-toggle="tooltip"
                                                                           title="Quitar campo"><i
                                                                                    class="fas fa-trash" disabled=""></i></a>
                                                                    </div>

                                                                <?php }
                                                                ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label ><span class="text-label">*Descripción corta</span></label>
                                                        <textarea name="descorta" id="descorta" rows="3" cols="80" >
                                                            <?php echo $prod->descripcion ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label ><span class="text-label">Detalles</span></label>
                                                        <textarea name="deslarga" id="deslarga" rows="10" cols="80">
                                                        <?php echo $prod->detalle?>
                                                        </textarea>
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