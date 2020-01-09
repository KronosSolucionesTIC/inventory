<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class MenuDAO
{
    private $conn;
    private $link;

    public function __construct()
    {
        $this->conn = new Conexion();
        $this->link = $this->conn->conectarse();
    }

    //Trae los items del menu nivel 1
    public function Menu()
    {
        $query  = "SELECT * FROM menu WHERE nivel1 = 1 and estado = 1 ORDER BY orden";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los items del menu nivel 2
    public function MenuNivel2($padre)
    {
        $query  = "SELECT * FROM menu WHERE nivel2 = 1 and estado = 1 and padre = " . $padre . " ORDER BY orden";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae los items del menu nivel 3
    public function MenuNivel3($padre)
    {
        $query  = "SELECT * FROM menu WHERE nivel3 = 1 and estado = 1 and padre = " . $padre . " ORDER BY orden";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
}
