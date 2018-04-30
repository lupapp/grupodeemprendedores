jQuery(function ($) {
    $('.buscar').focusout(function(){
        var palabra = $(this).val();
        if(palabra!='') {
            window.location.href = "GE-portafolio_servicios.php?criterio=" + palabra;
        }
    });
    $(".addCart").click(function(){
        $(this).find('.cargando').fadeIn();
        var id =$(this).data('id');
        var valor= $(this).attr('data-valor');
        var name=$(this).data('nombre');
        var img =$(this).data('img');
        var cantidad=$('.cantidad').val();
        var modi=$(this).attr('data-modi');
        var idClasif=$(this).attr('data-idclasif');
        var cupon=$('.cupon').val();
        $.ajax({
            type: "POST",
            url: "cargarcarro.php",
            data: {
                "id":id,
                "nombre":name,
                "valor":valor,
                "img":img,
                'cantidad':cantidad,
                'idclasif':idClasif,
                'modi':modi,
                'cupon':cupon
            },
            dataType: "html",
            error: function(){
                alert("error petición ajax");
            },
            success:function(data){
                $('.itemCart').html(data);
                $(this).find('.cargando').fadeOut();
                $(".cantItems").load("actualizarcantidad.php");
            }
        });

    });
    $(".cantItems").load("actualizarcantidad.php");
    $(".cancelCart").click(function(){
        $('.cargando').fadeIn();
        $(".itemCart").load("vaciar.php", function(){
            $('.cargando').fadeOut();
            $(".cantItems").load("actualizarcantidad.php");
        });
    });

    $('.itemCart').on('click', '.quitar' ,function(){
        $('.cargando').fadeIn();
        var id_prod = $(this).data('id');
        var id_cla=$(this).data('idcla');
        $.ajax({
            type: 'POST',
            url: 'cargarcarro.php',
            data: {
                'id-delete' : id_prod,
                'id_cla':id_cla
            },
            dataType: 'html',
            error: function(){
                alert('error petición ajax');
            },
            success:function(data){
                $('.itemCart').html(data);
                $('.cargando').fadeOut();
                $(".cantItems").load("actualizarcantidad.php");

            }
        });
    });
    $('.aplicar').click(function(){
        var cupon = $('.cupo').val();
        var valor =$(this).data('total');
        $.ajax({
            type: 'POST',
            url: 'GE-verificarcupon.php',
            data: {
                'cupon' : cupon,
                'valor':valor
            },
            dataType: 'html',
            error: function(){
                alert('error petición ajax');
            },
            success:function(data){
                if(data==0){
                    $('.cupo').attr('value', '');
                    $('.total').val(valor);
                    $('.totalCart').text(valor);
                    $('.alert-cupon').fadeIn().html('<div class="alert alert-danger">\n' +
                        '                                <strong>Error</strong> Cupon invalido o no disponible\n' +
                        '                            </div>');
                }else{
                    $('.cupo').attr('disabled','disabled');
                    $('.cupon').attr('value',cupon);
                    var des=valor-data;
                    $('.des').val(des);
                    $('.total').val(data);
                    $('.descuento').text(des);
                    $('.totalCart').text(data);
                    $('.alert-cupon').fadeIn().html('<div class="alert alert-success">\n' +
                        '                                <strong>Exito</strong> Cupon válido\n' +
                        '                            </div>');

                }

            }
        });
    });
    $('.abrircoment').click(function(){
        $('.comen').toggleClass('hidden');
    });
    $('.califica').click(function(){
        $('.cargando').fadeIn();
        var califica = $(this).val();
        var idpro=$('.idpro').val();
        var iduser=$('.iduser').val();
        var id=$('.id').val();
        $('.star').css({color:'#ffffff'})
        for(var i=1;i<=califica;i++){
            $('#califica_'+i).css({color:'#fcb92d'})
        }
        $.ajax({
            type: 'POST',
            url: 'GE-new-calificacion.php',
            data: {
                'califica':califica,
                'idpro' : idpro,
                'iduser':iduser,
                'id':id
            },
            dataType: 'html',
            error: function(){
                alert('error petición ajax');
            },
            success:function(data){
                $(".valoracion").load("GE-calificacion.php?id="+idpro);
            }
        });
    });
    function actualizar(clase, url){
        $(clase).load(url);
    }
    function actualizardatatotal(clase){
        $.get( "GE-actualizartotal.php", function( data ) {
            $(clase).attr('data-total', data);
        });
    }
    $('.itemsCart').on('click', '.quitar' ,function(){
        $('.cargando').fadeIn();
        var id_prod = $(this).data('id');
        var id_cla=$(this).data('idcla');
        $.ajax({
            type: 'POST',
            url: 'cargarcarro2.php',
            data: {
                'id-delete' : id_prod,
                'id_cla':id_cla
            },
            dataType: 'html',
            error: function(){
                alert('error petición ajax');
            },
            success:function(data){
                $('.itemsCart').html(data);
                $('.cargando').fadeOut();
                actualizar('.totalCart', 'GE-actualizartotal.php');
                actualizar('.descuento', 'GE-actualizardescuento.php');
                actualizardatatotal('.aplicar');
            }
        });
    });
    $('.itemsCart').on('change', '.cantid' ,function(){
        $('.cargando').fadeIn();
        var id_prod = $(this).data('id');
        var id_cla=$(this).data('idcla');
        var cant=$(this).val();
        $.ajax({
            type: 'POST',
            url: 'cargarcarro2.php',
            data: {
                'id_prod' : id_prod,
                'cant':cant,
                'id_cla':id_cla
            },
            dataType: 'html',
            error: function(){
                alert('error petición ajax');
            },
            success:function(data){
                $('.itemsCart').html(data);
                $('.cargando').fadeOut();
                $(".totalCart").load("GE-actualizartotal.php");
            }
        });
    });
    $('.noPayu').click(function(){
        $('.formPago').attr('action', 'paypal/comprar.php');
    });
    $('.payu').click(function(){
        $('.formPago').attr('action', 'GE-procesar-pedido.php');
    });
    $('.clasif').click(function(){
        var min=$(this).data('min');
        var max=$(this).data('max');
        var por=$(this).data('por');
        var idClasi=$(this).data('idclasif');
        if(por!=0){
            $('.addCart').attr('data-idclasif', idClasi);
            $('.addCart').attr('data-modi', 'nomodi');
        }else{
            $('.addCart').attr('data-idclasif', '0');
            $('.addCart').attr('data-modi', 'modi');
        }
        var valor=$('.valor').data('valor');
        var descuento=parseFloat(valor)*parseFloat(por)/100;
        var newvalor=valor-descuento;
        $('.valor').text(newvalor);
        $('.cantidad').attr('min', min).attr('max', max).val(min);
        $('.clasif').removeClass('btn-activo');
        $(this).toggleClass('btn-activo');
        $('.addCart').attr('data-valor', newvalor);

    });
    $('.cantidad').change(function () {
        var min=parseInt($(this).attr('min'));
        var max=parseInt($(this).attr('max'));
        var val=parseInt($(this).val());
        var por=$('.btn-activo').data('por');
        if(por!==undefined){
            var valor = $('.valor').data('valor');
            var descuento = parseFloat(valor) * parseFloat(por) / 100;
            var newvalor = valor - descuento;
            if (val < min || val > max) {
                $('.addCart').attr('data-valor', valor);
                $('.valor').text(valor);
            } else {
                $('.addCart').attr('data-valor', newvalor);
                $('.valor').text(newvalor);
            }
        }
    });
});