<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class Devolucion
{
    private $conn;
    private $link;

    public function __construct()
    {
        $this->conn = new Conexion();
        $this->link = $this->conn->conectarse();
    }

    //Trae todos los permisos
    public function getPermisos($id_usuario, $id_modulo)
    {
        $query = "select permisos.* FROM `permisos`
                    INNER JOIN persona on persona.fkID_cargo = permisos.fkID_cargo
                    INNER JOIN usuario on usuario.fkID_persona = persona.id_persona
                    WHERE usuario.id_usuario='" . $id_usuario . "' and fkID_modulo ='" . $id_modulo . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los permisos
    public function getPermisosconsulta($id_usuario)
    {
        $query = "SELECT fkID_cargo,fkID_proyecto,fkID_persona FROM `persona`
                INNER JOIN usuario on usuario.fkID_persona = persona.id_persona
                WHERE usuario.id_usuario='" . $id_usuario . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae las devoluciones
    public function getDevolucion($permisosConsulta)
    {
        if ($permisosConsulta[0]["fkID_cargo"] == 1) {
            $url = "";
        }
        if ($permisosConsulta[0]["fkID_cargo"] == 2) {
            $url = " AND fkID_proyecto= '" . $permisosConsulta[0]['fkID_proyecto'] . "'";
        }
        if ($permisosConsulta[0]["fkID_cargo"] == 3) {
            $url = " AND fkID_persona_a_cargo = '" . $permisosConsulta[0]['fkID_persona'] . "'";
        }

        $query = "SELECT * FROM devolucion
                WHERE devolucion.estado = 1" . $url;
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los proyectos
    public function getProyectos()
    {
        $query = "SELECT id_proyecto,nombre_proyecto FROM proyecto
                WHERE estado=1 ";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Lista de equipos
    public function listaEquipos($data)
    {
        $query = "SELECT CONCAT(nombres_persona, ' ', apellidos_persona) AS devuelve,fkID_persona_a_cargo,nombre_tipo_equipo,serial_equipo FROM asignar
                INNER JOIN inventario ON inventario.fkID_equipo = asignar.fkID_equipo
                INNER JOIN persona ON persona.id_persona = inventario.fkID_persona_a_cargo
                INNER JOIN equipo ON equipo.id_equipo = asignar.fkID_equipo
                INNER JOIN tipo_equipo ON tipo_equipo.id_tipo_equipo = equipo.fkID_tipo_equipo
                WHERE asignar.fkID_proyecto = '" . $data['fkID_proyecto'] . "' AND fkID_cargo = 2";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Crea una nueva devolucion
    public function insertaDevolucion($data)
    {
        //Consecutivo del movimiento
        $movimiento = $this->getConsecutivo(5);
        //Armar el consecutivo
        $contador    = $movimiento[0]["conse_tipo_movimiento"] + 1;
        $consecutivo = $movimiento[0]["inicial_tipo_movimiento"] . '-' . $contador;
        //Suma 1 al tipo de movimiento
        $this->sumaConsecutivo($contador, 5);

        //Archivo
        $nombre = $_FILES["archivo"]["name"];
        //Ruta
        $ruta = '../documentos/' . $nombre;
        if (isset($_FILES["archivo"]["name"])) {
            move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);
        }

        $query  = "INSERT INTO devolucion (fecha_devolucion, conse_devolucion, url_devolucion, observacion) VALUES (NOW(),'" . $consecutivo . "','" . $nombre . "','" . $data["observaciones"] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Arma el consecutivo
    public function getConsecutivo($fkID_tipo_movimiento)
    {
        $query  = "SELECT * FROM `tipo_movimiento` WHERE id_tipo_movimiento =  '" . $fkID_tipo_movimiento . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Suma 1 al consecutivo
    public function sumaConsecutivo($valor, $id_tipo_movimiento)
    {
        $query  = "UPDATE tipo_movimiento SET conse_tipo_movimiento = '" . $valor . "' WHERE id_tipo_movimiento = '" . $id_tipo_movimiento . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Trae las devoluciones funcionario
    public function getDevolucionFuncionario($permisosConsulta)
    {
        if ($permisosConsulta[0]["fkID_cargo"] == 1) {
            $url = "";
        }
        if ($permisosConsulta[0]["fkID_cargo"] == 2) {
            $url = " AND fkID_proyecto= '" . $permisosConsulta[0]['fkID_proyecto'] . "'";
        }
        if ($permisosConsulta[0]["fkID_cargo"] == 3) {
            $url = " AND fkID_persona_a_cargo = '" . $permisosConsulta[0]['fkID_persona'] . "'";
        }

        $query = "SELECT * FROM devolucion
                INNER JOIN proyecto ON proyecto.id_proyecto = devolucion.fkID_proyecto
                INNER JOIN persona AS entrega ON entrega.id_persona = devolucion.fkID_persona_entrega
                INNER JOIN territorial ON territorial.id_territorial = entrega.fkID_territorial
                WHERE devolucion.estado = 1 AND fkID_tipo_movimiento = 7" . $url;
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Lista territoriales
    public function listaTerritoriales($data)
    {
        $query = "SELECT id_territorial,nombre_territorial FROM territorial_proyecto
                INNER JOIN territorial ON territorial.id_territorial = territorial_proyecto.fkID_territorial
                WHERE territorial_proyecto.fkID_proyecto = '" . $data['fkID_proyecto'] . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Lista funcionarios
    public function listaFuncionarios($data)
    {
        $query = "SELECT id_persona,CONCAT(nombres_persona,' ',apellidos_persona) as nombre_persona FROM persona
                INNER JOIN territorial ON territorial.id_territorial = persona.fkID_territorial
                WHERE fkID_territorial = '" . $data['fkID_territorial'] . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Lista de equipos de funcionario
    public function listaEquiposFuncionario($data)
    {
        $query = "SELECT id_equipo,nombre_tipo_equipo,serial_equipo FROM inventario
                INNER JOIN persona ON persona.id_persona = inventario.fkID_persona_a_cargo
                INNER JOIN equipo ON equipo.id_equipo = inventario.fkID_equipo
                INNER JOIN tipo_equipo ON tipo_equipo.id_tipo_equipo = equipo.fkID_tipo_equipo
                WHERE id_persona = '" . $data['fkID_persona'] . "' ";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Crea una nueva devolucion funcionario
    public function insertaDevolucionFuncionario($data)
    {
        //Consecutivo del movimiento
        $movimiento = $this->getConsecutivo(7);
        //Armar el consecutivo
        $contador    = $movimiento[0]["conse_tipo_movimiento"] + 1;
        $consecutivo = $movimiento[0]["inicial_tipo_movimiento"] . '-' . $contador;
        //Suma 1 al tipo de movimiento
        $this->sumaConsecutivo($contador, 7);

        if (isset($_FILES["archivo"]["name"])) {
            //Archivo
            $nombre = $_FILES["archivo"]["name"];
            //Ruta
            $ruta = '../documentos/' . $nombre;
            move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);
        }

        $query  = "INSERT INTO devolucion (fecha_devolucion,fkID_tipo_movimiento,fkID_persona_entrega, fkID_persona_recibe, fkID_proyecto,conse_devolucion, url_devolucion, observacion) VALUES (NOW(),'7','" . $data["fkID_persona_entrega"] . "','" . $data["fkID_proyecto"] . "','" . $data["fkID_persona_recibe"] . "','" . $consecutivo . "','" . $nombre . "','" . $data["observaciones_funcionario"] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Inserta en detalle de devolucion
    public function insertaDetalleDevolucionFuncionario($data)
    {
        //Decodifica y saca / del array
        $data = json_decode(stripslashes($data["arrayEquipos"]));
        //Contador
        $numero = count($data);

        //Consulta el ultimo ID de devolucion
        $id_devolucion = $this->getIdDevolucion();
        //Recorre array equipos
        for ($i = 0; $i < $numero; $i++) {
            # code...
            $query  = "INSERT INTO detalle_devolucion (fkID_devolucion,fkID_equipo) VALUES ('" . $id_devolucion[0]["id_devolucion"] . "','" . $data[$i] . "')";
            $result = mysqli_query($this->link, $query);
        }

        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consulta el ultimo ID
    public function getIdDevolucion()
    {
        $query  = "SELECT id_devolucion FROM `devolucion` ORDER BY `devolucion`.`id_devolucion` DESC LIMIT 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
}
