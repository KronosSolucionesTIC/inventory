<?php
//include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class EmpleadoDAO
{
    private $conn;
    private $link;

    public function __construct()
    {
        $this->conn = new Conexion();
        $this->link = $this->conn->conectarse();
    }

    //Trae los generos
    public function Generos()
    {
        $query  = "SELECT * FROM genero WHERE estado_genero = 1 ORDER BY nombre_genero";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae la nacionalidad
    public function Nacionalidad()
    {
        $query  = "SELECT * FROM nacionalidad WHERE estado_nacionalidad = 1 ORDER BY nombre_nacionalidad";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae el estado civil
    public function EstadoCivil()
    {
        $query  = "SELECT * FROM estado_civil WHERE estado_civil = 1 ORDER BY nombre_estado_civil";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los departamentos
    public function Departamentos()
    {
        $query  = "SELECT * FROM departamento WHERE estado_departamento = 1 ORDER BY nombre_departamento";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae las ciudades
    public function Ciudades()
    {
        $query  = "SELECT * FROM ciudad WHERE estado_ciudad = 1 ORDER BY nombre_ciudad";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae las EPS
    public function Eps()
    {
        $query  = "SELECT * FROM eps WHERE estado_eps = 1 ORDER BY nombre_eps";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los fondos de pension
    public function Pension()
    {
        $query  = "SELECT * FROM pension WHERE estado_pension = 1 ORDER BY nombre_pension";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los fondos de cesantias
    public function Cesantias()
    {
        $query  = "SELECT * FROM cesantias WHERE estado_cesantias = 1 ORDER BY nombre_cesantias";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los bancos
    public function Bancos()
    {
        $query  = "SELECT * FROM banco WHERE estado_banco = 1 ORDER BY nombre_banco";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Consulta empleado por usuario
    public function EmpleadoUsuario($usuario)
    {
        $query = "SELECT * FROM usuario
                INNER JOIN empleado ON empleado.id_empleado = usuario.fkID_empleado
                WHERE idUsuario = " . $usuario;
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Consulta empleado por usuario
    public function InsertarEmpleado($query)
    {
        if (!$result = mysqli_query($this->link, $query)) {
            die('Se produjo un error al ejecutar la consulta: [' . $result->error . ']');
        } else {
            $this->r["estado"]  = "ok";
            $this->r["mensaje"] = "Guardado correctamente.";

            return $this->r;
        }
    }
}
