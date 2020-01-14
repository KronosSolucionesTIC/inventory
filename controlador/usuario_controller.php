<?php
include dirname(__file__, 2) . '/modelo/usuario.php';

$usuario = new Usuario();

//Request: creacion de nuevo usuario
if (isset($_POST['create'])) {
    if ($usuario->getID($_POST['subscriber'])) {
        header('location: ../views/usuario/new.php?page=new&existe=true');
    } else {
        if ($usuario->newClient($_POST)) {
            if ($usuario->newUser($_POST)) {
                header('location: ../views/usuario/new.php?page=new&success=true');
            }
        } else {
            header('location: ../views/usuario/new.php?page=new&error=true');
        }
    }

}

//Request: editar usuario
if (isset($_POST['edit'])) {
    if ($usuario->setEditUser($_POST)) {
        header('location: ../index.php?page=edit&id=' . $_POST['id'] . '&success=true');
    } else {
        header('location: ../index.php?page=edit&id=' . $_POST['id'] . '&error=true');
    }
}

//Request: editar usuario
if (isset($_GET['delete'])) {
    if ($usuario->deleteUser($_GET['id'])) {
        // header('location: ../index.php?page=usuario&success=true');
        echo json_encode(["success" => true]);
    } else {
        // header('location: ../index.php?page=usuario&&error=true');
        echo json_encode(["error" => true]);
    }
}

//Request: Ingresar
if (isset($_POST['Ingresar'])) {
    if ($usuario->getUserById($_POST['username'])) {
        if ($usuario->getPass($_POST['username'], $_POST['passwd'])) {
            $datosUsuario = $usuario->getUserById($_POST['username']);
            session_start(); //Registra la sesion
            $_SESSION['id_usuario'] = $datosUsuario[0]["idUsuario"];
            header('location: ../vista/index.php');
        } else {
            header('location: ../vista/login/index.php?pass=false');
        }
    } else {
        header('location: ../vista/login/index.php?existe=false');
    }
}
