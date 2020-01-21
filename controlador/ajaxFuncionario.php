<?php
include dirname(__file__, 2) . '/modelo/funcionario.php';

$funcionario = new Funcionario();
$tipo        = $_GET['tipo'];

if ($tipo == 'inserta') {
    if ($funcionario->insertaFuncionario($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'consulta') {
    $resultado = $funcionario->consultaFuncionario($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'edita') {
    if ($funcionario->editaFuncionario($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'elimina_logico') {
    if ($funcionario->eliminaLogicoFuncionario($_GET)) {
        return 'Se guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'valida_territorial') {
    $resultado = $funcionario->validaTerritorial($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}

if ($tipo == 'inserta_territorial') {
    if ($funcionario->insertaTerritorial($_GET)) {
        return 'Guardo';
    } else {
        return 'No se guardo';
    }
}

if ($tipo == 'ultima_territorial') {
    $resultado = $funcionario->ultimaTerritorial($_GET);
    if ($resultado) {
        echo json_encode($resultado); //imprime el json
    } else {
        return 'No se consulto';
    }
}
