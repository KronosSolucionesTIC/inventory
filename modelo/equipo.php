<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class Equipo
{
    private $conn;
    private $link;

    public function __construct()
    {
        $this->conn = new Conexion();
        $this->link = $this->conn->conectarse();
    }

    //Trae todos los equipos
    public function getEquipos()
    {
        $query = "SELECT * FROM equipo
                INNER JOIN tipo_equipo ON tipo_equipo.id_tipo_equipo = equipo.fkID_tipo_equipo
                INNER JOIN modelo ON modelo.id_modelo = equipo.fkID_modelo
                INNER JOIN marca ON marca.id_marca = equipo.fkID_marca
                INNER JOIN procesador ON procesador.id_procesador = equipo.fkID_procesador
                INNER JOIN estado_equipo ON estado_equipo.id_estado_equipo = equipo.fkID_estado
                WHERE equipo.estado = 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los tipos de equipos
    public function getTipoEquipo()
    {
        $query = "SELECT * FROM tipo_equipo
                ORDER BY nombre_tipo_equipo";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los modelos
    public function getModelo()
    {
        $query = "SELECT * FROM modelo
                ORDER BY nombre_modelo";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae las marcas
    public function getMarca()
    {
        $query = "SELECT * FROM marca
                ORDER BY nombre_marca";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los procesadores
    public function getProcesador()
    {
        $query = "SELECT * FROM procesador
                ORDER BY nombre_procesador";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Crea un nuevo equipo
    public function insertaEquipo($data)
    {
        $query  = "INSERT INTO equipo (serial_equipo,fkID_tipo_equipo,fkID_modelo,fkID_marca,fkID_procesador, observaciones_equipo,fkID_estado) VALUES ('" . $data['serial_equipo'] . "', '" . $data['fkID_tipo_equipo'] . "', '" . $data['fkID_modelo'] . "', '" . $data['fkID_marca'] . "', '" . $data['fkID_procesador'] . "', '" . $data['observaciones_equipo'] . "','1')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consultar equipo
    public function consultaEquipo($data)
    {
        $query = "SELECT * FROM equipo
                WHERE id_equipo = '" . $data['id_equipo'] . "'";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Edita un equipo
    public function editaEquipo($data)
    {
        $query  = "UPDATE equipo SET serial_equipo = '" . $data['serial_equipo'] . "',fkID_tipo_equipo = '" . $data['fkID_tipo_equipo'] . "',fkID_modelo = '" . $data['fkID_modelo'] . "',fkID_marca = '" . $data['fkID_marca'] . "' ,fkID_procesador = '" . $data['fkID_procesador'] . "', observaciones_equipo = '" . $data['observaciones_equipo'] . "' WHERE id_equipo = '" . $data['id_equipo'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Elimina logico un equipo
    public function eliminaLogicoEquipo($data)
    {
        $query  = "UPDATE equipo SET estado = '2' WHERE id_equipo = '" . $data['id_equipo'] . "'";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consulta el ultimo ID
    public function getIdEquipo()
    {
        $query  = "SELECT * FROM `equipo` ORDER BY `equipo`.`id_equipo` DESC LIMIT 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Inserta en inventario
    public function insertaInventario($data)
    {
        //Consulta el ultimo ID de equipo
        $id_equipo = $this->getIdEquipo();
        $query     = "INSERT INTO inventario (fkID_equipo,fkID_persona_a_cargo,fkID_territorial,obs_inventario) VALUES ('" . $id_equipo[0]["id_equipo"] . "','1','3','CREACIÓN DE EQUIPO')";
        $result    = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Inserta en historico
    public function insertaHistorico($data)
    {
        //Consulta el ultimo ID de equipo
        $id_equipo = $this->getIdEquipo();
        //Consecutivo del movimiento
        $movimiento = $this->getConsecutivo(6);
        //Armar el consecutivo
        $contador    = $movimiento[0]["conse_tipo_movimiento"] + 1;
        $consecutivo = $movimiento[0]["inicial_tipo_movimiento"] . '-' . $contador;
        //Suma 1 al tipo de movimiento
        $this->sumaConsecutivo($contador, 6);

        $query  = "INSERT INTO historico_equipo (fkID_equipo,fkID_persona_entrega,fkID_persona_recibe,fecha_historico_equipo,fkID_tipo_movimiento,conse_historico_equipo,obs_historico_equipo) VALUES ('" . $id_equipo[0]["id_equipo"] . "','1','1',NOW(),'6','" . $consecutivo . "','CREACIÓN DE EQUIPO')";
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

    //Valida el serial
    public function validaSerial($data)
    {
        $query  = "SELECT COUNT(*) AS cantidad FROM `equipo` WHERE serial_equipo =  '" . $data['serial_equipo'] . "' AND estado = 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Valida el tipo equipo
    public function validaTipoEquipo($data)
    {
        $query  = "SELECT COUNT(*) AS cantidad FROM `tipo_equipo` WHERE nombre_tipo_equipo =  '" . $data['nombre_tipo_equipo'] . "' AND estado = 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Crea un nuevo tipo equipo
    public function insertaTipoEquipo($data)
    {
        $query  = "INSERT INTO tipo_equipo (nombre_tipo_equipo) VALUES ('" . $data['nombre_tipo_equipo'] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consulta el ultimo ID de tipo equipo
    public function ultimoTipoEquipo()
    {
        $query  = "SELECT id_tipo_equipo,nombre_tipo_equipo FROM `tipo_equipo` ORDER BY `tipo_equipo`.`id_tipo_equipo` DESC LIMIT 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Valida el modelo
    public function validaModelo($data)
    {
        $query  = "SELECT COUNT(*) AS cantidad FROM `modelo` WHERE nombre_modelo =  '" . $data['nombre_modelo'] . "' AND estado = 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Crea un nuevo modelo
    public function insertaModelo($data)
    {
        $query  = "INSERT INTO modelo (nombre_modelo) VALUES ('" . $data['nombre_modelo'] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Consulta el ultimo ID de modelo
    public function ultimoModelo()
    {
        $query  = "SELECT id_modelo,nombre_modelo FROM `modelo` ORDER BY `modelo`.`id_modelo` DESC LIMIT 1";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
}
