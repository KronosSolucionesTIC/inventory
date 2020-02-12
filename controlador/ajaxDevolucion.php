<?php
include dirname(__file__, 2) . '/modelo/devolucion.php';

$devolucion = new devolucion();
$tipo       = $_POST['tipo'];

if ($tipo == 'lista_equipos') {
    $resultado = $devolucion->listaEquipos($_POST);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'inserta') {
    if ($devolucion->insertaDevolucion($_POST)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}
