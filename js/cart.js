jQuery(function ($) {
    $(".addCart").click(function(){
        $(this).find('.cargando').fadeIn();
        var id =$(this).data('id');
        var valor= $(this).data('valor');
        var name=$(this).data('nombre');
        var img =$(this).data('img');
        var cantidad=$('.cantidad').val();
        $.ajax({
            type: "POST",
            url: "cargarcarro.php",
            data: {
                "id":id,
                "nombre":name,
                "valor":valor,
                "img":img,
                'cantidad':cantidad
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
        $.ajax({
            type: 'POST',
            url: 'cargarcarro.php',
            data: {
                'id-delete' : id_prod
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
        $.ajax({
            type: 'POST',
            url: 'cargarcarro2.php',
            data: {
                'id-delete' : id_prod
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
        var cant=$(this).val();
        $.ajax({
            type: 'POST',
            url: 'cargarcarro2.php',
            data: {
                'id_prod' : id_prod,
                'cant':cant
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

});