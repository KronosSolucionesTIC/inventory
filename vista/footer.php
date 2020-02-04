
        <!-- Core plugin JavaScript-->

        <!-- Custom scripts for all pages-->
        <script src="componentes/js/sb-admin-2.min.js">
        </script>
        <!-- Page level plugins -->
        <script src="componentes/vendor/chart.js/Chart.min.js">
        </script>
        <!-- Page level custom scripts -->
        <script src="componentes/js/demo/chart-area-demo.js">
        </script>


 </body>
 </html>
 <script type="text/javascript">
    //esta cargando el archivo tabla.php en el div tabla
    $(document).ready(function(){
        //$('#tabla').load('usuario/Vusuario.php')
    });

    $("#menu_usuarios").click(function(){
        $('#tabla').load('usuario/Vusuario.php');
        $("#titulo").html('&nbsp;Usuarios');
    });

    //Redireccion a index de equipos
    $("#menu_equipos").click(function(){
        $('#tabla').load('equipos/index.php');
        $("#titulo").html('&nbsp;Equipos');
    });

    //Redireccion a index de funcionario
    $("#menu_funcionarios").click(function(){
        $('#tabla').load('funcionarios/index.php');
        $("#titulo").html('&nbsp;Funcionarios');
    });

    //Redireccion a index de informes
    $("#informe_total").click(function(){
        $('#tabla').load('informes/inventario_total.php');
        $("#titulo").html('&nbsp;Informes');
    });

</script>
