jQuery(function ($) {
    $(".addCart").click(function(){
        $(this).find('.cargando').fadeIn();
        var id =$(this).data('id');
        var valor= $(this).attr('data-valor');
        var name=$(this).data('nombre');
        var img =$(this).data('img');
        var cantidad=$('.cantidad').val();
        var modi=$(this).attr('data-modi');
        var idClasif=$(this).attr('data-idclasif');
        alert(idClasif);
        alert(modi);
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
                'modi':modi
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
    $('.abrircoment').click(function(){
        $('.comen').toggleClass('hidden');
    });
    $('.enviarcoment').on('click', '.quitar' ,function(){
        $('.cargando').fadeIn();
        var id_prod = $('.').data('id');
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
    $('.itemsCart').on('click', '.quitar' ,function(){
        $('.cargando').fadeIn();
        var id_prod = $(this).data('id');
        var id_cla=$(this).data('idcla');
        alert(id_cla);
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
                $(".totalCart").load("GE-actualizartotal.php");
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