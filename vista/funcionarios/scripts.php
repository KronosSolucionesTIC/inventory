<script type="text/javascript">
    //Funcion para el Datatable
    $(document).ready(function () {
        $('#tablaFuncionarios').DataTable(
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

    //Funcion boton crear funcionario
    $("#btn_crear_funcionario").click(function(){
        $("#modalFuncionarioLabel").text("Crear funcionario");
        $("#btn_guardar_funcionario").attr("data-accion","crear");
        $("#form_funcionario")[0].reset();
    });

    //Funcion guardar funcionario
    $("#btn_guardar_funcionario").click(function(){
        resultado = campos_incompletos();
        if(resultado == true){
            accion = $(this).attr('data-accion');
            if(accion == 'crear'){
                crea_funcionario();
            }
            if(accion == 'editar'){
                edita_funcionario();
            }
        }
    });

    //Campos incompletos
    function campos_incompletos(){
        var bandera = true;
        if($("#nombres_persona").val().length == 0){
            bandera = false;
        }
        if($("#apellidos_persona").val().length == 0){
            bandera = false;
        }
        if($('#documento_persona').val().trim() == 0){
            bandera = false;
        }
        if($('#fkID_territorial').val().trim() == 0){
            bandera = false;
        }
        if($('#fkID_area').val().trim() == 0){
            bandera = false;
        }
        if($('#fkID_proyecto').val().trim() == 0){
            bandera = false;
        }
        if(bandera == false){
            alert('Complete el formulario');
            return false;
        } else {
            return true;
        }
    }

    //Funcion para guardar el funcionario
    function crea_funcionario(){
        nombres_persona = $("#nombres_persona").val();
        apellidos_persona = $("#apellidos_persona").val();
        documento_persona = $("#documento_persona").val();
        telefono_persona = $("#telefono_persona").val();
        celular_persona = $("#celular_persona").val();
        email_persona = $("#email_persona").val();
        fkID_territorial = $("#fkID_territorial").val();
        fkID_area = $("#fkID_area").val();
        fkID_tipo_persona = $("#fkID_tipo_persona").val();
        fkID_proyecto = $("#fkID_proyecto").val();
        fkID_cetap = $("#fkID_cetap").val();

        $.ajax({
          url: "../controlador/ajaxFuncionario.php",
          data: 'nombres_persona='+nombres_persona+'&apellidos_persona='+apellidos_persona+'&documento_persona='+documento_persona+'&telefono_persona='+telefono_persona+'&celular_persona='+celular_persona+'&email_persona='+email_persona+'&fkID_territorial='+fkID_territorial+'&fkID_area='+fkID_area+'&fkID_tipo_persona='+fkID_tipo_persona+'&fkID_proyecto='+fkID_proyecto+'&fkID_cetap='+fkID_cetap+'&tipo=inserta'
        })
        .done(function(data) {
          //---------------------
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

    //Funcion para cargar sitio
    function cargar_sitio(){
        $("#modalFuncionario").removeClass("show");
        $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove();//eliminamos el backdrop del modal
        $('#tabla').load('funcionarios/index.php');
    }

    //Funcion guardar equipo
    $("[name*='btn_editar']").click(function(){
        id_funcionario = $(this).attr('data-id-funcionario');
        $("#modalFuncionarioLabel").text("Editar funcionario");
        carga_funcionario(id_funcionario);
        $("#btn_guardar_funcionario").attr("data-accion","editar");
    });

    //Carga el funcionario por el ID
    function carga_funcionario(id_funcionario){

        console.log("Carga el funcionario "+ id_funcionario);

        $.ajax({
            url: "../controlador/ajaxFuncionario.php",
            data: "id_funcionario="+id_funcionario+"&tipo=consulta",
            dataType: 'json'
        })
        .done(function(data) {

            $.each(data[0], function( key, value ) {
              console.log(key+"--"+value);
              $("#"+key).val(value);
            });

            id_funcionario = data.id_funcionario;
        })
        .fail(function(data) {
            console.log(data);
        })
        .always(function(data) {
            console.log(data);
        });
    };

    //Funcion para guardar el funcionario
    function edita_funcionario(){
        id_persona = $("#id_persona").val();
        nombres_persona = $("#nombres_persona").val();
        apellidos_persona = $("#apellidos_persona").val();
        documento_persona = $("#documento_persona").val();
        telefono_persona = $("#telefono_persona").val();
        celular_persona = $("#celular_persona").val();
        email_persona = $("#email_persona").val();
        fkID_territorial = $("#fkID_territorial").val();
        fkID_area = $("#fkID_area").val();
        fkID_tipo_persona = $("#fkID_tipo_persona").val();
        fkID_proyecto = $("#fkID_proyecto").val();
        fkID_cetap = $("#fkID_cetap").val();

        $.ajax({
          url: "../controlador/ajaxFuncionario.php",
          data: 'id_persona='+id_persona+'&nombres_persona='+nombres_persona+'&apellidos_persona='+apellidos_persona+'&documento_persona='+documento_persona+'&telefono_persona='+telefono_persona+'&celular_persona='+celular_persona+'&email_persona='+email_persona+'&fkID_territorial='+fkID_territorial+'&fkID_area='+fkID_area+'&fkID_tipo_persona='+fkID_tipo_persona+'&fkID_proyecto='+fkID_proyecto+'&fkID_cetap='+fkID_cetap+'&tipo=edita'
        })
        .done(function(data) {
          //---------------------
          console.log(data);
          alertify.success('Editado correctamente');
          setTimeout('cargar_sitio()',1000);
        })
        .fail(function(data) {
          console.log(data);
        })
         always(function(data) {
          console.log(data);
        });
    }

    //Funcion eliminar equipo
    $("[name*='btn_eliminar']").click(function(){
        id_funcionario = $(this).attr('data-id-funcionario');
        $("#btn_eliminar_funcionario").attr("data-id-funcionario",id_funcionario);
    });

    //Funcion eliminar funcionario
    $("[name*='btn_eliminar_funcionario']").click(function(){
        id_funcionario = $(this).attr('data-id-funcionario');
        elimina_funcionario(id_funcionario);
    });

    //Funcion para eliminar el funcionario
    function elimina_funcionario(id_persona){
        $.ajax({
          url: "../controlador/ajaxFuncionario.php",
          data: 'id_persona='+id_persona+'&tipo=elimina_logico'
        })
        .done(function(data) {
          //---------------------
          console.log(data);
          alertify.success('Eliminado correctamente');
          setTimeout('cargar_sitio()',1000);
        })
        .fail(function(data) {
          console.log(data);
        })
         always(function(data) {
          console.log(data);
        });
    }

    //Funcion guardar territorial
    $("#btn_guardar_territorial").click(function(){
        validar_territorial();
        return false;
    });

    //Funcion para validar mterritorial
    function validar_territorial(){
        nombre_territorial = $("#nombre_territorial").val();

        $.ajax({
          url: "../controlador/ajaxFuncionario.php",
          data: 'nombre_territorial='+nombre_territorial+'&tipo=valida_territorial',
          dataType: 'json'
        })
        .done(function(data) {
          //---------------------
          if(data[0]["cantidad"] >0){
            alert('La territorial ya esta registrada');
            $("#nombre_territorial").val("");
            $("#nombre_territorial").focus();
          } else {
            crea_territorial();
          }
        })
        .fail(function(data) {
          console.log(data);
        });
    }

    //Funcion para guardar el marca
    function crea_territorial(){
        nombre_territorial = $("#nombre_territorial").val();

        $.ajax({
          url: "../controlador/ajaxFuncionario.php",
          data: 'nombre_territorial='+nombre_territorial+'&tipo=inserta_territorial'
        })
        .done(function(data) {
          //---------------------
          console.log(data);
          $("#modalTerritorial").removeClass("show");
          $("#modalTerritorial").removeClass("modal-backdrop");
          carga_territorial();
          $("#nombre_territorial").val("");
        })
        .fail(function(data) {
          console.log(data);
        })
         always(function(data) {
          console.log(data);
        });
    }

    //Funcion para cargar el registro guardado
    function carga_territorial(){

        $.ajax({
            url: "../controlador/ajaxFuncionario.php",
            data: "tipo=ultima_territorial",
            dataType: 'json'
        })
        .done(function(data) {

            $.each(data[0], function( key, value ) {
                console.log(key+"--"+value);
                if(key == "id_territorial"){
                    optionValue = value;
                }
                if(key == "nombre_territorial")
                    optionText = value;
            });
            $('#fkID_territorial').append(new Option(optionText, optionValue));
            $('#fkID_territorial').val(optionValue);
            alert('Guardada la territorial');
        })
        .fail(function(data) {
            console.log(data);
        })
        .always(function(data) {
            console.log(data);
        });
    };
</script>
