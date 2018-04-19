<header class="b-header--bottom-menu">
  <?php
  $cat=new Categoria($con);
  $ca=$cat->getAll();
  ?>
  <div class="b-top-options-panel b-header--hide">

          <div class="container">
              <div class="b-option-contacts f-option-contacts">
                  <a href="mailto:info@grupodeemprendedores.com"><i class="far fa-envelope"></i> info@grupodeemprendedores.com</a>
                  <a href="#"><i class="fa fa-phone"></i> 57 + 310 231 6451 </a>
                  <a href="#"><i class="fab fa-skype"></i> grupoemprendedores.company</a>
              </div>
              <div class="b-right">
                  <span class="b-option-contacts f-option-contacts navbar navbar-inverse">
                      <?php if(isset($_SESSION['user'])) { ?>
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user"></i> <?php echo $_SESSION["user"]["usuario"]; ?>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu b-top-user">
                                <li class="b-top-nav__2level f-top-nav__2level f-primary f-top-nav__2level_title"><a href="GE-micuenta.php">Mi Cuenta</a></li>
                                <li class="b-top-nav__2level f-top-nav__2level f-primary f-top-nav__2level_title"><a href="logout.php">Cerrar Sesión</a></li>
                            </ul>
                     <?php }else{ ?>
                      <a href="GE-login.php">
                              <i class="fa fa-user"></i> Login / Registro
                      </a>
                      <?php } ?>|
                      <a href="#"><i class="fa fa-info-circle"></i> Ayuda</a>
                  </span>
              </div>
          </div>
      </div>
      <div class="container b-header__box b-header--hide">
          <a href="index.php" class="b-left b-logo"><img class="color-theme" data-retina src="img/logo-header-default.png" alt="Logo" /></a>
          <div class="b-right b-header-ico-group f-header-ico-group b-right">
              <span class="b-header__search-box">
                  <i class="fa fa-search"></i>
                  <input type="text" placeholder="Ingresa palabra(s) clave(s)"/>
              </span>
              <span class="b-header__social-box">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                  <a href="#"><i class="fab fa-linkedin-in"></i></a>
              </span>
          </div>
          <div class="b-top-nav-show-slide f-top-nav-show-slide j-top-nav-show-slide b-right"><i class="fa fa-align-justify"></i></div>
      </div>
      <div class="container b-relative">
          <div class="b-header-r">
              <nav class="b-top-nav b-top-nav--bottom b-top-nav--bottom--icon f-top-nav j-top-nav b-top-nav--icon">
                  <ul class="b-top-nav__1level_wrap">
    <li class="b-top-nav__1level f-top-nav__1level is-active-top-nav__1level f-primary-b"><a href="index.php"><i class="fa fa-home b-menu-1level-ico"></i>Inicio <span class="b-ico-dropdown"><i class="fa fa-arrow-circle-down"></i></span></a>
        
    </li>
    <li class="b-top-nav__1level f-top-nav__1level f-primary-b">
        <a href="#"><i class="fa fa-user b-menu-1level-ico"></i>Quienes Somos<span class="b-ico-dropdown"><i class="fa fa-arrow-circle-down"></i></span></a>
        
    </li>
    <li class="b-top-nav__1level f-top-nav__1level f-primary-b">
        <a href="GE-portafolio_servicios.php"><i class="fa fa-suitcase b-menu-1level-ico"></i>Servicios <span class="b-ico-dropdown"><i class="fa fa-arrow-circle-down"></i></span></a>
        <div class="b-top-nav__dropdomn">
            <ul class="b-top-nav__2level_wrap">
                <li class="b-top-nav__2level_title f-top-nav__2level_title"><a href="GE-portafolio_servicios.php">Todos</a></li>
                <?php foreach ($ca as $c){ ?>
                <li class="b-top-nav__2level f-top-nav__2level f-primary"><a href="GE-portafolio_servicios.php?id=<?php echo $c->id ?>"><i class="<?php echo $c->img ?>"></i> <?php echo $c->nombre ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </li>
    
    <li class="b-top-nav__1level f-top-nav__1level f-primary-b">
        <a href="#"><i class="fa fa-trophy b-menu-1level-ico"></i>Membresias<span class="b-ico-dropdown"><i class="fa fa-arrow-circle-down"></i></span></a>
        <div class="b-top-nav__dropdomn">
            <ul class="b-top-nav__2level_wrap">
                <li class="b-top-nav__2level f-top-nav__2level f-primary f-top-nav__2level_title"><a href="#"><i class="fa fa-angle-right"></i>Full</a></li>
                <li class="b-top-nav__2level f-top-nav__2level f-primary f-top-nav__2level_title"><a href="#"><i class="fa fa-angle-right"></i>Basic</a></li>
                <li class="b-top-nav__2level f-top-nav__2level f-primary f-top-nav__2level_title"><a href="#"><i class="fa fa-angle-right"></i>Seguimiento</a></li>
                <li class="b-top-nav__2level f-top-nav__2level f-primary f-top-nav__2level_title"><a href="#"><i class="fa fa-angle-right"></i>cursos Training</a></li>
            </ul>               
            
        </div>
    </li>
    <li class="b-top-nav__1level f-top-nav__1level f-primary-b">
        <a href="GE-testimonios.php"><i class="fab fa-weixin b-menu-1level-ico"></i>Testimonios <span class="b-ico-dropdown"><i class="fa fa-arrow-circle-down"></i></span></a>
    </li>
    <li class="b-top-nav__1level f-top-nav__1level f-primary-b">
        <a href="#"><i class="fas fa-image b-menu-1level-ico"></i>Galería <span class="b-ico-dropdown"><i class="fa fa-arrow-circle-down"></i></span></a>
    </li>
    <li class="b-top-nav__1level f-top-nav__1level f-primary-b">
        <a href="GE-blog_lista.php"><i class="fa fa-book b-menu-1level-ico"></i>Noticias <span class="b-ico-dropdown"><i class="fa fa-arrow-circle-down"></i></span></a>
    </li>
     
    <li class="b-top-nav__1level f-top-nav__1level f-primary-b">
        <a href="#"><i class="fa fa-headphones b-menu-1level-ico"></i>Contacto<span class="b-ico-dropdown"><i class="fa fa-arrow-circle-down"></i></span></a>        
    </li>
    
</ul>

              </nav>

          </div>
      </div>

</header>