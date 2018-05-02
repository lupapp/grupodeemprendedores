$('document').ready(function(){
    function notificar(){
        $('.noti').load('../../controller/verificar-fecha.php');
    }
    notificar();
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
    $('#dataTable').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Ningun resultado",
            "info": "página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "decimal":        "",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "infoPostFix":    "",
            "thousands":      ",",
            "loadingRecords": "Leyendo...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "aria": {
                "sortAscending":  ": activar para ordenar la columna ascendente",
                "sortDescending": ": activar para ordenar la columna descendiente"
            }
        },
        "dom":"<'row datatables-header form-inline'<'col-sm-6 col-md-5'l><'col-sm-12 col-md-5'f>>" +
            "<'table-responsive'<'col-sm-12 col-md-12'tr>>" +
        "<'row datatables-footer'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    });


});