$(function(){
    //Funcion para crear empleado
    $("#crear_empleado").click(function(){
      var data = new FormData($("#form_empleado_crear")[0]);
      data.append('file', $("#url_lista").get(0).files[0]);
      console.log(data);
      data.append('tipo','crear');
        $.ajax({
          type: "POST",
          url: "../../ajax/insertar.php",
          data: data,
          contentType: false,
          processData: false,
          success:function(data){
            console.log(data)
            alert('Guardado correctamente');
            location.reload();
          },
          error:function(error){
            console.log(error)
          }
      });
        return false;
    });

    //Funcion para editar empleado
    $("#editar_empleado").click(function(){
      var data = new FormData($("#form_empleado_editar")[0]);
      data.append('file', $("#foto_editar").get(0).files[0]);
      console.log(data);
      data.append('tipo','editar');
        $.ajax({
          type: "POST",
          url: "../../ajax/insertar.php",
          data: data,
          contentType: false,
          processData: false,
          success:function(data){
            console.log(data)
            alert('Editado correctamente');
            location.reload();
          },
          error:function(error){
            console.log(error)
          }
      });
        return false;
    });

});