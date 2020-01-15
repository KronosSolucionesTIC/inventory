<?php
include dirname(__file__, 2) . '/modelo/equipo.php';

$equipo = new Equipo();
$tipo   = $_GET['tipo'];

if ($tipo == 'inserta') {
    if ($equipo->insertaEquipo($_GET)) {
        if ($equipo->insertaInventario($_GET)) {
            if ($equipo->insertaHistorico($_GET)) {
                return 'Se guardo';
            }
        }
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'consulta') {
    $resultado = $equipo->consultaEquipo($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'edita') {
    if ($equipo->editaEquipo($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'elimina_logico') {
    if ($equipo->eliminaLogicoEquipo($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'valida_serial') {
    $resultado = $equipo->validaSerial($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'valida_tipo_equipo') {
    $resultado = $equipo->validaTipoEquipo($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'inserta_tipo_equipo') {
    if ($equipo->insertaTipoEquipo($_GET)) {
        return 'Guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'ultimo_tipo_equipo') {
    $resultado = $equipo->ultimoTipoEquipo($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}
