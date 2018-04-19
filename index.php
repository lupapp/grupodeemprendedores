<?php session_start();
$mipagina = "index";
spl_autoload_register(function ($clase) {
    include 'Administer/class/'.$clase.'/'.$clase.'.php';
});
$con=new Conexion();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Grupo de Emprendedores</title>
  <link rel="shortcut icon" href="favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!-- bxslider -->
<link type="text/css" rel='stylesheet' href="js/bxslider/jquery.bxslider.css">
<!-- End bxslider -->
<!-- flexslider -->
<link type="text/css" rel='stylesheet' href="js/flexslider/flexslider.css">
<!-- End flexslider -->

<!-- bxslider -->
<link type="text/css" rel='stylesheet' href="js/radial-progress/style.css">
<!-- End bxslider -->

<!-- Animate css -->
<link type="text/css" rel='stylesheet' href="css/animate.css">
<!-- End Animate css -->

<!-- Bootstrap css -->
<link type="text/css" rel='stylesheet' href="css/bootstrap.min.css">
<link type="text/css" rel='stylesheet' href="js/bootstrap-progressbar/bootstrap-progressbar-3.2.0.min.css">
<!-- End Bootstrap css -->

<!-- Jquery UI css -->
<link type="text/css" rel='stylesheet' href="js/jqueryui/jquery-ui.css">
<link type="text/css" rel='stylesheet' href="js/jqueryui/jquery-ui.structure.css">
<!-- End Jquery UI css -->

<!-- Fancybox -->
<link type="text/css" rel='stylesheet' href="js/fancybox/jquery.fancybox.css">
<!-- End Fancybox -->

<link type="text/css" rel='stylesheet' href="fonts/fonts.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

<link type="text/css" data-themecolor="default" rel='stylesheet' href="css/main-default.css">

<link type="text/css" rel='stylesheet' href="js/rs-plugin/css/settings.css">
<link type="text/css" rel='stylesheet' href="js/rs-plugin/css/settings-custom.css">
<link type="text/css" rel='stylesheet' href="js/rs-plugin/videojs/video-js.css">
</head>
<body>
  <div class="mask-l" style="background-color: #fff; width: 100%; height: 100%; position: fixed; top: 0; left:0; z-index: 9999999;"></div> <!--removed by integration-->

  <?php include("GE-cabezote.php"); ?>
<div class="j-menu-container"></div>

  <div class="l-main-container">
  <div class="b-slidercontainer">
    <div class="b-slider j-fullscreenslider">
        <ul>
            <li data-transition="3dcurtain-vertical" data-slotamount="7">
                <div class="tp-bannertimer"></div>
                <img data-retina src="img/slider/slider-lg__bg.png">
                <div class="caption sfb"  data-x="center" data-y="bottom" data-speed="700" data-start="1700" data-easing="Power4.easeOut" style="z-index: 2">
                    <img data-retina src="img/slider/partner/client-logo-1h.png">
                </div>
                <div class="caption sfl"  data-x="50" data-y="bottom" data-speed="700" data-start="2500" data-easing="Power4.easeOut">
                    <img data-retina src="img/slider/slider_shop_1-1.png">
                </div>
                <div class="caption sfr"  data-x="right" data-y="bottom" data-hoffset="-30" data-speed="700" data-start="2500" data-easing="Power4.easeOut">
                    <img data-retina src="img/slider/client-logo-1.png">
                </div>
                <div class="caption lft"  data-x="center" data-y="30" data-speed="600" data-start="2600">
                    <h1 class="f-primary-b c-white" >Grupo de emprendedores</h1>
                </div>
                <div class="caption"  data-x="center" data-y="90" data-speed="600" data-start="3200">
                    <p class="f-primary-b f-slider-lg-item__text_desc f-center c-white" >
                        Para Corporación, Negocios, Educación, Talleres...
                        <br/>
                        y mucho más en la membresia                     </p>
                </div>
            </li>
            <li data-transition="" data-slotamount="7">
                <div class="tp-bannertimer"></div>
                <img data-retina src="img/slider/slider-lg__bg.png">
                <div class="caption sfb"  data-x="30" data-y="bottom" data-speed="700" data-start="1700" data-easing="Power4.easeOut"><img data-retina src="img/slider/slider_shop_1-1.png"></div>
                <div class="caption"  data-x="180" data-y="bottom" data-voffset="-1" data-speed="2100" data-start="3300" data-easing="easeOutBack"><img data-retina src="img/slider/slider_shop_1-2.png"></div>
                <div class="caption lfr"  data-x="400"  data-y="100" data-speed="300" data-start="2000">
                    <div class="b-header-group f-header-group f-header-group--light">
                        <h2 class="f-primary-l">Membresias</h2>
                        <h1 class="f-primary-sb">Especiales</h1>
                    </div>
                </div>
                
                <div class="caption lfb"  data-x="400" data-y="300" data-speed="300" data-start="2600">
                    <p class="f-primary-b f-uppercase f-slider-lg_text-medium c-white" >Vestibulum scelerisque in enim </p>
                </div>
                <div class="caption"  data-x="400" data-y="340" data-speed="600" data-start="3000">
                    <p><a class="b-link f-link f-primary-b f-uppercase" href="#">más info <span><i class="fa fa-chevron-right"></i></span></a></p>
                </div>
            </li>
        </ul>
    </div>
</div>

<section class="b-bg-full-primary">
  <div class="container">
    <div class="b-categories-icons">
      <div class="b-categories-icons__item f-categories-icons__item b-column">
        <a class="b-categories-icons__item_link" href="education_listing.html">
          <div class="b-categories-icons__item_icon f-categories-icons__item_icon fade-in-animate">
            <i class="fa fa-microphone"></i>
          </div>
          <div class="b-remaining b-categories-icons__item_text">
            <div class="b-categories-icons__item_name f-categories-icons__item_name f-secondary-b">Conferencias</div>
            <div class="b-categories-icons__item_info f-categories-icons__item_info f-secondary-l">Sobre PNL, Couching, Formación, Reinvención Profecional. </div>
          </div>
        </a>
      </div>
      <div class="b-categories-icons__item f-categories-icons__item b-column">
        <a class="b-categories-icons__item_link" href="education_listing.html">
          <div class="b-categories-icons__item_icon f-categories-icons__item_icon fade-in-animate">
            <i class="fa fa-puzzle-piece"></i>
          </div>
          <div class="b-remaining b-categories-icons__item_text">
            <div class="b-categories-icons__item_name f-categories-icons__item_name f-secondary-b">Talleres</div>
            <div class="b-categories-icons__item_info f-categories-icons__item_info f-secondary-l">Didacticos para Empresas e Instituciones, Grupos abiertos.  </div>
          </div>
        </a>
      </div>
      <div class="b-categories-icons__item f-categories-icons__item b-column">
        <a class="b-categories-icons__item_link" href="education_listing.html">
          <div class="b-categories-icons__item_icon f-categories-icons__item_icon fade-in-animate">
            <i class="fa fa-users"></i>
          </div>
          <div class="b-remaining b-categories-icons__item_text">
            <div class="b-categories-icons__item_name f-categories-icons__item_name f-secondary-b"> Consultoría</div>
            <div class="b-categories-icons__item_info f-categories-icons__item_info f-secondary-l">Accusantium quam, ultricies eget tempor </div>
          </div>
        </a>
      </div>
      <div class="b-categories-icons__item f-categories-icons__item b-column">
        <a class="b-categories-icons__item_link" href="education_listing.html">
          <div class="b-categories-icons__item_icon f-categories-icons__item_icon fade-in-animate">
            <i class="fa fa-graduation-cap"></i>
          </div>
          <div class="b-remaining b-categories-icons__item_text">
            <div class="b-categories-icons__item_name f-categories-icons__item_name f-secondary-b">Cursos training</div>
            <div class="b-categories-icons__item_info f-categories-icons__item_info f-secondary-l">Accusantium quam, ultricies eget tempor </div>
          </div>
        </a>
      </div>
      <div class="b-categories-icons__item f-categories-icons__item b-column">
        <a class="b-categories-icons__item_link" href="education_listing.html">
          <div class="b-categories-icons__item_icon f-categories-icons__item_icon fade-in-animate">
            <i class="fa fa-book"></i>
          </div>
          <div class="b-remaining b-categories-icons__item_text">
            <div class="b-categories-icons__item_name f-categories-icons__item_name f-secondary-b">Libros </div>
            <div class="b-categories-icons__item_info f-categories-icons__item_info f-secondary-l">Accusantium quam, ultricies eget tempor </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>
<section class="b-infoblock f-center">
  <div class="container">
    <h2 class="f-secondary-l">Proximos <strong class="f-secondary-b">Eventos</strong> o Cursos</h2>

    <p class="b-infoblock-description f-desc-section f-secondary-l f-small">Reprehendunt in, quo ea esse civibus suavitate. Pro
      gubergren persecuti moderatius, id laudem vix, an eos. Adversarium principes.</p>

    <div class="b-some-examples f-some-examples f-secondary row">
      <div class="col-sm-4 col-xs-12">
        <div class="b-some-examples__item f-some-examples__item">
          <div class="b-some-examples__item_img view view-sixth">
    <a href="#"><img class="j-data-element" data-animate="fadeInDown" data-retina src="img/homepage/example_1.jpg" alt=""/></a>
    <div class="b-item-hover-action f-center mask">
        <div class="b-item-hover-action__inner">
            <div class="b-item-hover-action__inner-btn_group">
                <a href="education_detail.html" class="b-btn f-btn b-btn-light f-btn-light info"><i class="fa fa-link"></i></a>
            </div>
        </div>
    </div>
</div>
          <div class="b-some-examples__item_info">
            <div class="b-some-examples__item_info_level b-some-examples__item_name f-some-examples__item_name"><a href="education_detail.html" title="Curso PNL Programación NeuroLinguistica"><strong>Curso PNL Programación NeuroLinguistica</strong></a></div>
            <div class="b-some-examples__item_info_level b-some-examples__item_double_info f-some-examples__item_double_info">
              <div class="b-right">Duración: 6 Meses</div>
              <div class="b-remaining">Inicia: Marzo 19, 2018</div>
            </div>
            <div class="b-some-examples__item_info_level b-some-examples__item_description f-some-examples__item_description">
              Suspendisse blandit ligula turpis, ac convallis risus fermentum non. Duis vestibulum quis quam vel accumsan
              dertook grunted less jeez hound.
            </div>
          </div>
          <div class="b-some-examples__item_action">
            <div class="b-right">
              <a href="#" class="b-btn f-btn b-btn-sm f-btn-sm b-btn-default f-secondary-b">Ver más</a>
              <a href="#" class="b-btn f-btn b-btn-sm f-btn-sm button-gray-light f-secondary-b">Ver Paquetes</a>
            </div>
            <div class="b-remaining b-some-examples__item_total f-some-examples__item_total">$90.000/ Mes</div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 col-xs-12">
        <div class="b-some-examples__item f-some-examples__item">
          <div class="b-some-examples__item_img view view-sixth">
    <a href="#"><img class="j-data-element" data-animate="fadeInDown" data-retina src="img/homepage/example_2.jpg" alt=""/></a>
    <div class="b-item-hover-action f-center mask">
        <div class="b-item-hover-action__inner">
            <div class="b-item-hover-action__inner-btn_group">
                <a href="education_detail.html" class="b-btn f-btn b-btn-light f-btn-light info"><i class="fa fa-link"></i></a>
            </div>
        </div>
    </div>
</div>
          <div class="b-some-examples__item_info">
            <div class="b-some-examples__item_info_level b-some-examples__item_name f-some-examples__item_name"><a href="education_detail.html" title="Seminario Potencialización RRHH">Seminario Potencialización RRHH</a></div>
            <div class="b-some-examples__item_info_level b-some-examples__item_double_info f-some-examples__item_double_info">
              <div class="b-right">Duración: 6 Meses</div>
              <div class="b-remaining">Inicia: Marzo 19, 2018</div>
            </div>
            <div class="b-some-examples__item_info_level b-some-examples__item_description f-some-examples__item_description">
              Suspendisse blandit ligula turpis, ac convallis risus fermentum non. Duis vestibulum quis quam vel accumsan
              dertook grunted less jeez hound.
            </div>
          </div>
          <div class="b-some-examples__item_action">
            <div class="b-right">
              <a href="#" class="b-btn f-btn b-btn-sm f-btn-sm b-btn-default f-secondary-b">Ver más</a>
              <a href="#" class="b-btn f-btn b-btn-sm f-btn-sm button-gray-light f-secondary-b">Ver Paquetes</a>
            </div>
            <div class="b-remaining b-some-examples__item_total f-some-examples__item_total">$90.000/ Mes</div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 col-xs-12">
        <div class="b-some-examples__item f-some-examples__item">
          <div class="b-some-examples__item_img view view-sixth">
    <a href="#"><img class="j-data-element" data-animate="fadeInDown" data-retina src="img/homepage/example_3.jpg" alt=""/></a>
    <div class="b-item-hover-action f-center mask">
        <div class="b-item-hover-action__inner">
            <div class="b-item-hover-action__inner-btn_group">
                <a href="education_detail.html" class="b-btn f-btn b-btn-light f-btn-light info"><i class="fa fa-link"></i></a>
            </div>
        </div>
    </div>
</div>
          <div class="b-some-examples__item_info">
            <div class="b-some-examples__item_info_level b-some-examples__item_name f-some-examples__item_name"><a href="education_detail.html" title="Reinvención Profecional">Reinvención Profesional</a></div>
            <div class="b-some-examples__item_info_level b-some-examples__item_double_info f-some-examples__item_double_info">
              <div class="b-right">Duración: 6 Meses</div>
              <div class="b-remaining">Inicia: Marzo 19, 2018</div>
            </div>
            <div class="b-some-examples__item_info_level b-some-examples__item_description f-some-examples__item_description">
              Suspendisse blandit ligula turpis, ac convallis risus fermentum non. Duis vestibulum quis quam vel accumsan
              dertook grunted less jeez hound.
            </div>
          </div>
          <div class="b-some-examples__item_action">
            <div class="b-right">
              <a href="#" class="b-btn f-btn b-btn-sm f-btn-sm b-btn-default f-secondary-b">Ver más</a>
              <a href="#" class="b-btn f-btn b-btn-sm f-btn-sm button-gray-light f-secondary-b">Ver Paquetes</a>
            </div>
            <div class="b-remaining b-some-examples__item_total f-some-examples__item_total">$90.000/ Mes</div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<section class="b-bg-block f-bg-block b-bg-block-education">
  <div class="container f-center">
    <h1 class="f-secondary-b">FORMA PARTE DEL  <strong>GRUPO DE EMPRENDEDORES</strong></h1>

    <div class="b-bg-block__desc f-bg-block__desc f-secondary">Cum sociis natoque penatibus et magnis dis parturient
      montes, nascetur ridiculus mus
    </div>
    <a class="b-btn f-btn b-btn-md f-btn-md b-btn-primary f-primary-sb j-data-element" data-animate="shake" ><i class="fa fa-desktop"></i> ver demo</a>
    <span class="clearfix visible-xs-block"></span>
    <a class="b-btn f-btn b-btn-md f-btn-md f-primary-sb j-data-element" data-animate="shake" ><i class="fa fa-money"></i> Quiero Unirme</a>
  </div>
</section>
<section class="b-infoblock b-diagonal-line-bg-light f-secondary">
  <div class="container">
    <h2 class="f-center f-secondary-l"> <i class="fa fa-wechat"></i><br/> <strong>Testimonios</strong>  </h2>

    <p class="b-infoblock-description f-desc-section f-center f-employee__desc f-small">Algunos de los Testimonios de Vida de quienes han participado de alguno de nuestros servicios.</p>

      <div class="b-carousel-primary">
          <div class="j-carousel-primary">
              <div class="b-carousel-primary__item">
                  <div class="b-news-item f-news-item">
                      <div class="hidden-xs b-news-item__img view view-sixth">
    <img data-retina="" src="img/homepage/news_1.png" alt="">
    <div class="b-item-hover-action f-center mask">
        <div class="b-item-hover-action__inner">
            <div class="b-item-hover-action__inner-btn_group">
                <a href="blog_detail_right_slidebar.html" class="b-btn f-btn b-btn-light f-btn-light info"><i class="fa fa-link"></i></a>
            </div>
        </div>
    </div>
</div>
                      <div class="b-news-item__info">
                          <div class="b-news-item__info_title f-news-item__info_title f-primary-b">Jhon Doe</div>
                          <div class="b-news-item__info_additional">
                                <span class="f-news-item__info_additional_item b-news-item__info_additional_item">
                                    <i class="fa fa-calendar-o"></i> 22, Febrero
                                </span>                               
                          </div>
                          <div class="b-news-item__info_text f-news-item__info_text">
                              Vestibulum accumsan habitasse dictum id ut Curabitur amet libero mauris condimentum. Ut in lobortis
                              nulla sed augueuisque aenean
                          </div>
                          <a class="f-news-item__info_more f-more f-secondary-b" href="blog_detail_right_slidebar.html">Ver más <i class="fa fa-chevron-circle-right"></i></a>
                      </div>
                  </div>
              </div>
              <div class="b-carousel-primary__item">
                  <div class="b-news-item f-news-item">
                      <div class="hidden-xs b-news-item__img view view-sixth">
    <img data-retina="" src="img/homepage/news_1.png" alt="">
    <div class="b-item-hover-action f-center mask">
        <div class="b-item-hover-action__inner">
            <div class="b-item-hover-action__inner-btn_group">
                <a href="blog_detail_right_slidebar.html" class="b-btn f-btn b-btn-light f-btn-light info"><i class="fa fa-link"></i></a>
            </div>
        </div>
    </div>
</div>
                      <div class="b-news-item__info">
                          <div class="b-news-item__info_title f-news-item__info_title f-primary-b">Joan Doe</div>
                          <div class="b-news-item__info_additional">
                                <span class="f-news-item__info_additional_item b-news-item__info_additional_item">
                                    <i class="fa fa-calendar-o"></i> 22, Marzo
                                </span>
                          </div>
                          <div class="b-news-item__info_text f-news-item__info_text">
                              Vestibulum accumsan habitasse dictum id ut Curabitur amet libero mauris condimentum. Ut in lobortis
                              nulla sed augueuisque aenean
                          </div>
                          <a class="f-news-item__info_more f-more f-secondary-b" href="blog_detail_right_slidebar.html">Ver más <i
                                  class="fa fa-chevron-circle-right"></i></a>
                      </div>
                  </div>
              </div>
              <div class="b-carousel-primary__item">
                  <div class="b-news-item f-news-item">
                      <div class="hidden-xs b-news-item__img view view-sixth">
    <img data-retina="" src="img/homepage/news_1.png" alt="">
    <div class="b-item-hover-action f-center mask">
        <div class="b-item-hover-action__inner">
            <div class="b-item-hover-action__inner-btn_group">
                <a href="blog_detail_right_slidebar.html" class="b-btn f-btn b-btn-light f-btn-light info"><i class="fa fa-link"></i></a>
            </div>
        </div>
    </div>
</div>
                      <div class="b-news-item__info">
                          <div class="b-news-item__info_title f-news-item__info_title f-primary-b">J.Jhon Dooe</div>
                          <div class="b-news-item__info_additional">
                                <span class="f-news-item__info_additional_item b-news-item__info_additional_item">
                                    <i class="fa fa-calendar-o"></i> 22, Abril
                                </span>
                          </div>
                          <div class="b-news-item__info_text f-news-item__info_text">
                              Vestibulum accumsan habitasse dictum id ut Curabitur amet libero mauris condimentum. Ut in lobortis
                              nulla sed augueuisque aenean
                          </div>
                          <a class="f-news-item__info_more f-more f-secondary-b" href="blog_detail_right_slidebar.html">Ver más <i
                                  class="fa fa-chevron-circle-right"></i></a>
                      </div>
                  </div>
              </div>
              <div class="b-carousel-primary__item">
                  <div class="b-news-item f-news-item">
                      <div class="hidden-xs b-news-item__img view view-sixth">
    <img data-retina="" src="img/homepage/news_2.png" alt="">
    <div class="b-item-hover-action f-center mask">
        <div class="b-item-hover-action__inner">
            <div class="b-item-hover-action__inner-btn_group">
                <a href="blog_detail_right_slidebar.html" class="b-btn f-btn b-btn-light f-btn-light info"><i class="fa fa-link"></i></a>
            </div>
        </div>
    </div>
</div>
                      <div class="b-news-item__info">
                          <div class="b-news-item__info_title f-news-item__info_title f-primary-b">J.Jhon Dooe</div>
                          <div class="b-news-item__info_additional">
                                <span class="f-news-item__info_additional_item b-news-item__info_additional_item">
                                    <i class="fa fa-calendar-o"></i> 22, Abril
                                </span>
                          </div>
                          <div class="b-news-item__info_text f-news-item__info_text">
                              Vestibulum accumsan habitasse dictum id ut Curabitur amet libero mauris condimentum. Ut in lobortis
                              nulla sed augueuisque aenean
                          </div>
                          <a class="f-news-item__info_more f-more f-secondary-b" href="blog_detail_right_slidebar.html">Ver más <i
                                  class="fa fa-chevron-circle-right"></i></a>
                      </div>
                  </div>
              </div>
              <div class="b-carousel-primary__item">
                  <div class="b-news-item f-news-item">
                      <div class="hidden-xs b-news-item__img view view-sixth">
    <img data-retina="" src="img/homepage/news_1.png" alt="">
    <div class="b-item-hover-action f-center mask">
        <div class="b-item-hover-action__inner">
            <div class="b-item-hover-action__inner-btn_group">
                <a href="blog_detail_right_slidebar.html" class="b-btn f-btn b-btn-light f-btn-light info"><i class="fa fa-link"></i></a>
            </div>
        </div>
    </div>
</div>
                      <div class="b-news-item__info">
                          <div class="b-news-item__info_title f-news-item__info_title f-primary-b">J.Jhon Dooe</div>
                          <div class="b-news-item__info_additional">
                                <span class="f-news-item__info_additional_item b-news-item__info_additional_item">
                                    <i class="fa fa-calendar-o"></i> 22, Abril
                                </span>
                          </div>
                          <div class="b-news-item__info_text f-news-item__info_text">
                              Vestibulum accumsan habitasse dictum id ut Curabitur amet libero mauris condimentum. Ut in lobortis
                              nulla sed augueuisque aenean
                          </div>
                          <a class="f-news-item__info_more f-more f-secondary-b" href="blog_detail_right_slidebar.html">Ver más <i
                                  class="fa fa-chevron-circle-right"></i></a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>


<div class="b-info-container f-info-container">
  <div class="container">
    <div class="b-info-container__title f-info-container__title">
      <i class="fa fa-twitter"></i><br/>
      <span class="f-b f-secondary-b">Jose Luis Diaz</span> <br>
			Couching
    </div>
    <p class="b-info-container__text f-info-container__text f-secondary-l-it">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In accumsan porttitor egestas.<br/> Suspendisse gravida ultrices convallis. Interdum et malesuada fames <a href="http://bly.shotlinks.com">http://bly.shotlinks.com</a></p>
  </div>
</div>
</div>

 <?php include("GE-pie.php"); ?>
  
<script src="js/breakpoints.js"></script>
<script src="js/jquery/jquery-1.11.1.min.js"></script>
<!-- bootstrap -->
<script src="js/scrollspy.js"></script>
<script src="js/bootstrap-progressbar/bootstrap-progressbar.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- end bootstrap -->
<script src="js/masonry.pkgd.min.js"></script>
<script src='js/imagesloaded.pkgd.min.js'></script>
<!-- bxslider -->
<script src="js/bxslider/jquery.bxslider.min.js"></script>
<!-- end bxslider -->
<!-- flexslider -->
<script src="js/flexslider/jquery.flexslider.js"></script>
<!-- end flexslider -->
<!-- smooth-scroll -->
<script src="js/smooth-scroll/SmoothScroll.js"></script>
<!-- end smooth-scroll -->
<!-- carousel -->
<script src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
<!-- end carousel -->
<script src="js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script src="js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="js/rs-plugin/videojs/video.js"></script>

<!-- jquery ui -->
<script src="js/jqueryui/jquery-ui.js"></script>
<!-- end jquery ui -->
<script type="text/javascript" language="javascript"
        src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCfVS1-Dv9bQNOIXsQhTSvj7jaDX7Oocvs"></script>
<!-- Modules -->
<script src="js/modules/sliders.js"></script>
<script src="js/modules/ui.js"></script>
<script src="js/modules/retina.js"></script>
<script src="js/modules/animate-numbers.js"></script>
<script src="js/modules/parallax-effect.js"></script>
<script src="js/modules/settings.js"></script>
<script src="js/modules/maps-google.js"></script>
<script src="js/modules/color-themes.js"></script>
<!-- End Modules -->

<!-- Audio player -->
<script type="text/javascript" src="js/audioplayer/js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/audioplayer/js/jplayer.playlist.min.js"></script>
<script src="js/audioplayer.js"></script>
<!-- end Audio player -->

<!-- radial Progress -->
<script src="js/radial-progress/jquery.easing.1.3.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/d3/3.4.13/d3.min.js"></script>
<script src="js/radial-progress/radialProgress.js"></script>
<script src="js/progressbars.js"></script>
<!-- end Progress -->

<!-- Google services -->
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
<script src="js/google-chart.js"></script>
<!-- end Google services -->
<script src="js/j.placeholder.js"></script>

<!-- Fancybox -->
<script src="js/fancybox/jquery.fancybox.pack.js"></script>
<script src="js/fancybox/jquery.mousewheel.pack.js"></script>
<script src="js/fancybox/jquery.fancybox.custom.js"></script>
<!-- End Fancybox -->
<script src="js/user.js"></script>
<script src="js/timeline.js"></script>
<script src="js/fontawesome-markers.js"></script>
<script src="js/markerwithlabel.js"></script>
<script src="js/cookie.js"></script>
<script src="js/loader.js"></script>
<script src="js/scrollIt/scrollIt.min.js"></script>
<script src="js/modules/navigation-slide.js"></script>
  <!-- Font Awesome(iconos) -->
  <?php include 'footer.php'; ?>
</body>
</html>
