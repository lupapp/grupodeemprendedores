$('document').ready(function(){
    $('.close').click(function(){
        $(this).attr('aria-hidden', true);
    });
    //$('#btnDel').attr('disabled','disabled');
    $('.icono').click(function() {
        $('.icono').removeClass('icono-select');
        $(this).toggleClass('icono-select');
    });
    var icono = $('.iconoAct').val();
    $('.labelIcono').each(function(){
        if(icono==$(this).find('input').val()){
            $(this).find('h3').addClass('icono-select');
        }
    });
    $('#btnAdd').click(function() {
        var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
        var newNum = new Number(num + 1); // the numeric ID of the new input field being added

        // create the new element via clone(), and manipulate it's ID using newNum value
        var newElem = $('#Add' + num).clone().attr('id', 'Add' + newNum);

        // manipulate the name/id values of the input inside the new element
        newElem.children(':first').attr('id', 'name' + newNum).attr('name', 'especificacion[]');
        newElem.children(':last').attr('id', 'name' + newNum).attr('name', 'valEsp[]');
        // insert the new element after the last "duplicatable" input field
        $('#Add' + num).after(newElem);

        // enable the "remove" button
        $('#btnDel').attr('disabled',false);

        // business rule: you can only add 10 names
        if (newNum == 10)
            $('#btnAdd').attr('disabled','disabled');
        alert(num);
    });

    $('#btnDel').click(function() {
        var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
        $('#Add' + num).remove(); // remove the last element

        // enable the "add" button
        $('#btnAdd').attr('disabled',false);

        // if only one element remains, disable the "remove" button
        if (num == 2)
            $('#btnDel').attr('disabled','disabled');
    });
    $('.deleteImg').click(function() {
        var id = $(this).data('id');
        var ruta=$('#et-img'+id).attr('src');
        $.ajax({
            type: 'POST',
            url: 'editProducto.php',
            data: {
                'id': id,
                'delete': 'delete',
                'ruta':ruta
            },
            dataType: 'html',
            error: function () {
                alert('error petición ajax buscar notificaciones');
            },
            success: function (data) {
                $('#img' + id).fadeOut();
            }
        });
    });

});