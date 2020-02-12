<script type="text/javascript">
    //Funcion para el Datatable
    $(document).ready(function () {
        $('#tablaDevolucion').DataTable(
            {
                "pagingType": "full_numbers",
                "lengthMenu": [[ 10, 25, 50, -1], [ 10, 25, 50, "Todos"]],
                "language": {
                    "lengthMenu":     "Mostrando _MENU_ registros",
                    "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                    "search":         "Buscar:",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "zeroRecords": "No hay registros que coincidan.",
                    "infoEmpty": "No se encuentran registros.",
                    "infoFiltered":   "(Filtrando _MAX_ registros en total)",
                    "paginate": {
                        "first":      "<--",
                        "last":       "-->",
                        "next":       ">",
                        "previous":   "<"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                },
                "order": []
            }
        );
    });

    //Funcion boton crear devolucion
    $("#btn_crear_devolucion").click(function(){
        $("#modalDevolucionProyectoLabel").text("Crear devolución");
        $("#btn_guardar_devolucion_proyecto").attr("data-accion","crear");
        $("#form_devolucion_proyecto")[0].reset();
        $("#btn_guardando").hide();
        limpiar_campos();
    });

    //Funcion para limpiar campos
    function limpiar_campos(){
        $("input").removeClass('is-invalid');
        $("input").removeClass('is-valid');
        $("select").removeClass('is-invalid');
        $("select").removeClass('is-valid');
    }

    //Lista los equipos de cada proyecto
    $("#fkID_proyecto").change(function(){
        fkID_proyecto = $(this).val();
        $.ajax({
            url: "../controlador/ajaxDevolucion.php",
            data: "fkID_proyecto="+fkID_proyecto+"&tipo=lista_equipos",
            dataType: 'json',
            type: 'POST'
        })
        .done(function(data) {
            if(data.length >0){
                borra_items();
                for (var i = 0; i < data.length; i++) {
                    var htmlTags = '<tr>';
                    htmlTags += '<td><input type="checkbox" /></td>';
                    htmlTags += '<td>'+ data[i]["nombre_tipo_equipo"] + '</td>';
                    htmlTags += '<td>'+ data[i]["serial_equipo"] + '</td>';
                    htmlTags += '<td>'+ data[i]["devuelve"] + '</td>';
                    htmlTags += '</tr>';
                    $('#tablaDevolucionProyectos tbody').append(htmlTags);
                }
            }
        })
        .fail(function(data) {
            borra_items();
            alertify.alert(
                'No existen equipos',
                'El proyecto seleccionado no tiene equipos asignados',
                function(){
                    alertify.error('Verifique el proyecto');
            });
        })
        .always(function(data) {
            console.log(data);
        });
    });

    //Borra la tabla
    function borra_items(){
        $("#tablaDevolucionProyectos td").remove();
    }

    //Funcion guardar devolucion
    $("#btn_guardar_devolucion").click(function(){
        resultado = campos_incompletos();
        if(resultado == true){
            accion = $(this).attr('data-accion');
            if(accion == 'crear'){
                crea_devolucion();
            }
            if(accion == 'editar'){
                edita_devolucion();
            }
        }
    });

    //Campos incompletos
    function campos_incompletos(){
        return true;
    }

    //Funcion para cargar sitio
    function cargar_sitio(){
        $("#modalEquipo").removeClass("show");
        $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove();//eliminamos el backdrop del modal
        $('#tabla').load('devolucion/index.php');
    }

    function crea_devolucion(){
        var parametros = new FormData($("#form_devolucion_proyecto")[0]);
        parametros.append("tipo", "inserta");
        parametros.append("observaciones",$("#observaciones").val());

        $.ajax({
          url: "../controlador/ajaxDevolucion.php",
          data: parametros,
          contentType: false,
          processData: false,
          type: 'POST'
        })
        .done(function(data) {
            console.log(data);
          //---------------------
          $("#btn_guardar_devolucion").hide();
          $("#btn_guardando").show();
          alertify.success('Creado correctamente');
          setTimeout('cargar_sitio()',1000);
        })
        .fail(function(data) {
          console.log(data);
        })
         always(function(data) {
          console.log(data);
        });
    }
</script>
