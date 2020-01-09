<?php
include dirname(__file__, 2) . "/config/conexion.php";
include dirname(__file__, 2) . '/modelo/empleado.php';

$r                          = array();
$tipo                       = isset($_POST['tipo']) ? $_POST['tipo'] : "";
$id_empleado                = isset($_POST['id_empleado']) ? $_POST['id_empleado'] : "";
$ape1_empleado              = isset($_POST['ape1_empleado']) ? $_POST['ape1_empleado'] : "";
$ape2_empleado              = isset($_POST['ape2_empleado']) ? $_POST['ape2_empleado'] : "";
$nombre_empleado            = isset($_POST['nombre_empleado']) ? $_POST['nombre_empleado'] : "";
$fecha_nac_empleado         = isset($_POST['fecha_nac_empleado']) ? $_POST['fecha_nac_empleado'] : "";
$fkID_genero_empleado       = isset($_POST['fkID_genero_empleado']) ? $_POST['fkID_genero_empleado'] : "";
$cedula_empleado            = isset($_POST['cedula_empleado']) ? $_POST['cedula_empleado'] : "";
$fkID_nacionalidad_empleado = isset($_POST['fkID_nacionalidad_empleado']) ? $_POST['fkID_nacionalidad_empleado'] : "";
$fkID_civil_empleado        = isset($_POST['fkID_civil_empleado']) ? $_POST['fkID_civil_empleado'] : "";
$direccion_empleado         = isset($_POST['direccion_empleado']) ? $_POST['direccion_empleado'] : "";
$fkID_depar_empleado        = isset($_POST['fkID_depar_empleado']) ? $_POST['fkID_depar_empleado'] : "";
$fkID_ciudad_empleado       = isset($_POST['fkID_ciudad_empleado']) ? $_POST['fkID_ciudad_empleado'] : "";
$telefono_empleado          = isset($_POST['telefono_empleado']) ? $_POST['telefono_empleado'] : "";
$celular_empleado           = isset($_POST['celular_empleado']) ? $_POST['celular_empleado'] : "";
$fkID_eps_empleado          = isset($_POST['fkID_eps_empleado']) ? $_POST['fkID_eps_empleado'] : "";
$fkID_pension_empleado      = isset($_POST['fkID_pension_empleado']) ? $_POST['fkID_pension_empleado'] : "";
$fkID_cesantias_empleado    = isset($_POST['fkID_cesantias_empleado']) ? $_POST['fkID_cesantias_empleado'] : "";
$rh_empleado                = isset($_POST['rh_empleado']) ? $_POST['rh_empleado'] : "";
$fkID_banco_empleado        = isset($_POST['fkID_banco_empleado']) ? $_POST['fkID_banco_empleado'] : "";
$cuenta_empleado            = isset($_POST['cuenta_empleado']) ? $_POST['cuenta_empleado'] : "";
$email_empleado             = isset($_POST['email_empleado']) ? $_POST['email_empleado'] : "";

//Guarda la foto
if (isset($_FILES['file']["name"])) {
    $url_foto = $_FILES['file']["name"];
} else {
    $url_foto = "";
}

if ($url_foto != "") {
    $url_foto = str_replace(" ", "_", $url_foto);
    $destino  = "../imagenes/fotos/" . $url_foto;
    if (move_uploaded_file($_FILES['file']["tmp_name"], $destino)) {
        $url_foto = $url_foto;
    } else {
        $url_foto    = "";
        $r["estado"] = "Error servidor" . $_FILES["file"]["error"];
    }
}

switch ($tipo) {
    case 'crear':
        //Instancia del empleado
        $empleado   = new EmpleadoDAO();
        $query      = "INSERT INTO empleado (ape1_empleado,ape2_empleado,nombre_empleado,fecha_nac_empleado,fkID_genero_empleado,cedula_empleado,fkID_nacionalidad_empleado,fkID_civil_empleado,direccion_empleado,fkID_depar_empleado,fkID_ciudad_empleado,telefono_empleado,celular_empleado,fkID_eps_empleado,fkID_pension_empleado,fkID_cesantias_empleado,rh_empleado,fkID_banco_empleado,cuenta_empleado,email_empleado,foto_empleado) VALUES ('$ape1_empleado','$ape2_empleado','$nombre_empleado','$fecha_nac_empleado','$fkID_genero_empleado','$cedula_empleado','$fkID_nacionalidad_empleado','$fkID_civil_empleado','$direccion_empleado','$fkID_depar_empleado','$fkID_ciudad_empleado','$telefono_empleado','$celular_empleado','$fkID_eps_empleado','$fkID_pension_empleado','$fkID_cesantias_empleado','$rh_empleado','$fkID_banco_empleado','$cuenta_empleado','$email_empleado','$url_foto')";
        $r["query"] = $query;

        $resultado = $empleado->InsertarEmpleado($query);

        if ($resultado) {
            $r[] = $resultado;
        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    case 'editar':
        //Instancia del empleado
        $empleado   = new EmpleadoDAO();
        $query      = "UPDATE empleado SET ape1_empleado = '$ape1_empleado' ,ape2_empleado = '$ape2_empleado' ,nombre_empleado = '$nombre_empleado',fecha_nac_empleado = '$fecha_nac_empleado',fkID_genero_empleado = '$fkID_genero_empleado',cedula_empleado = '$cedula_empleado',fkID_nacionalidad_empleado = '$fkID_nacionalidad_empleado',fkID_civil_empleado = '$fkID_civil_empleado',direccion_empleado = '$direccion_empleado',fkID_depar_empleado = '$fkID_depar_empleado',fkID_ciudad_empleado = '$fkID_ciudad_empleado',telefono_empleado = '$telefono_empleado',celular_empleado = '$celular_empleado',fkID_eps_empleado = '$fkID_eps_empleado',fkID_pension_empleado = '$fkID_pension_empleado',fkID_cesantias_empleado = '$fkID_cesantias_empleado',rh_empleado = '$rh_empleado' ,fkID_banco_empleado = '$fkID_banco_empleado',cuenta_empleado = '$cuenta_empleado',email_empleado = '$email_empleado',foto_empleado = '$url_foto' WHERE id_empleado = '$id_empleado'";
        $r["query"] = $query;

        $resultado = $empleado->InsertarEmpleado($query);

        if ($resultado) {
            $r[] = $resultado;
        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        echo json_encode($r);
        break;
    default:
        echo json_encode($r);
        break;
}
