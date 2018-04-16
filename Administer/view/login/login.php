<?php
session_start();
spl_autoload_register(function ($clase) {
    include '../../class/'.$clase.'/'.$clase.'.php';
});
if(isset($_POST['submit'])){
    $pass= isset($_POST['pass']) ? $_POST['pass'] : '';
    $user= isset($_POST['user']) ? $_POST['user'] : '';
    if (empty($pass) or empty($user)){
        header('Location: login.php?ms="El usuario o el pasword no pueden estar vacios"');
    }
    $login = new Login(new Conexion());
    $login->setPass($pass);
    $login->setUser($user);
    $resul=$login->signIn();
    $_SESSION['user']=$resul['user'];
    if($resul['existe']==1){
        if($resul['user']['tipo']==1) {
            header('Location: ../desktop');
        }else{
            $ms='Ingrese con un usuario administrador';
        }
    }else{
        $ms=$resul['ms'];
    }
}

?>
<!doctype html>
<html class="fixed">
<head>

    <!-- Basic -->
    <?php include("../../llamadosheadLogin.php"); ?>

    <title>Login / AdministerPro</title>
</head>
<body>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a ref="" class="logo pull-left">
            <img src="../../assets/images/logo.png" height="90" alt="IProgramer" />
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> INICIAR SESIÓN</h2>
            </div>
            <div class="panel-body">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form1" id="form1">
                    <?php
                    if(!isset($ms)) {
                        $ms = $pass = isset($_GET['ms']) ? $_GET['ms'] : '';
                    }
                    if (empty($ms)){}else{?>

                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Error:</strong> <?php echo $ms ?>
                        </div>
                    <?php }?>
                    <div class="form-group mb-lg">
                        <label>Usuario</label>
                        <div class="input-group input-group-icon">
                            <input name="user" id="txtLogin" type="text" class="form-control input-lg"  />
                            <span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
                        </div>
                    </div>

                    <div class="form-group mb-lg">
                        <div class="clearfix">
                            <label class="pull-left">Contraseña</label>

                        </div>
                        <div class="input-group input-group-icon">
                            <input name="pass" id="txtPassword" type="password" class="form-control input-lg" />
                            <span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-12 text-right">
                            <button type="submit" name="submit" class="btn btn-primary hidden-xs">INGRESAR</button>
                            <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">INGRESAR</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md">&copy; Copyright <?php echo date("Y"); ?>. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->

<!-- Vendor -->
<script src="../../assets/vendor/jquery/jquery.js"></script>
<script src="../../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="../../assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="../../assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="../../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="../../assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="../../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="../../assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="../../assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="../../assets/javascripts/theme.init.js"></script>
<script src="../../assets/js/scripts.js"></script>

</body>
</html>