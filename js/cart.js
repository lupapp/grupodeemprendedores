jQuery(function ($) {
    $(".addCart").click(function(){
        $(this).find('.cargando').fadeIn();
        var id =$(this).data('id');
        var valor= $(this).data('valor');
        var name=$(this).data('nombre');
        var img =$(this).data('img');
        var cantidad=$(this).data('cantidad');
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

});