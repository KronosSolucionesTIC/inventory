<?php
include dirname(__file__, 2) . "/config/conexion.php";
/**
 *
 */
class Usuario
{
    private $conn;
    private $link;

    public function __construct()
    {
        $this->conn = new Conexion();
        $this->link = $this->conn->conectarse();
    }

    //Trae todos los usuario registrados
    public function getUsuario()
    {
        $query  = "SELECT * FROM usuario";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos CIUU
    public function getCIIU()
    {
        $query  = "SELECT * FROM tb_ciiucode";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos sectores
    public function getSector()
    {
        $query  = "SELECT * FROM tb_sectorbusiness";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los tamaños
    public function getTamano()
    {
        $query  = "SELECT * FROM tb_typecomp";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los departamentos
    public function getDpto()
    {
        $query  = "SELECT * FROM tb_departments";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Trae todos los municipios
    public function getMuni()
    {
        $query  = "SELECT * FROM tb_municip";
        $result = mysqli_query($this->link, $query);
        $data   = array();
        while ($data[] = mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    //Crea un nuevo cliente
    public function newClient($data)
    {
        $query  = "INSERT INTO tb_client (business_name,subscriber,department,municipality) VALUES ('" . $data['business_name'] . "','" . $data['subscriber'] . "','" . $data['department'] . "','" . $data['municipality'] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Crea un nuevo usuario
    public function newUser($data)
    {
        //Genera clave aleatoria
        $cantidad_car = 8;
        $cadena_base  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $cadena_base .= '0123456789';
        $cadena_base .= '!@#%^&*()_,./<>?;:[]{}\|=+';

        $password = '';
        $limite   = strlen($cadena_base) - 1;

        for ($i = 0; $i < $cantidad_car; $i++) {
            $password .= $cadena_base[rand(0, $limite)];
        }
        //Genera clave aleatoria

        $query  = "INSERT INTO usuario (usuarioNombre,password,email) VALUES ('" . $data['subscriber'] . "','" . $password . "','" . $data['email'] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            //Envia correo
            $cuerpo = "Bienvenido al aplicativo a continuacion se listan datos de acceso:";
            $cuerpo = $cuerpo . "Usuario: " . $data['subscriber'];
            $cuerpo = $cuerpo . "Contraseña: " . $password;
            $this->enviarMail($data['email'], "usuarioNombre y password", $cuerpo);
            $this->enviarMail($data['email2'], "usuarioNombre y password", $cuerpo);
            return true;
        } else {
            return false;
        }
    }

    //Crea un nuevo usuario
    public function newContact($data)
    {
        $query  = "INSERT INTO tb_contact (name) VALUES ('" . $data['nomContacto'] . "')";
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Obtiene el usuario por id
    public function getUserById($usuarioNombre = null)
    {
        if (!empty($usuarioNombre)) {
            $query  = "SELECT * FROM usuario WHERE nombre = '" . $usuarioNombre . "'";
            $result = mysqli_query($this->link, $query);
            $data   = array();
            while ($data[] = mysqli_fetch_assoc($result));
            array_pop($data);
            return $data;
        } else {
            return false;
        }
    }

    //Verifica contraseña
    public function getPass($usuarioNombre = null, $password = null)
    {
        if (!empty($usuarioNombre)) {
            if (!empty($password)) {
                $query  = "SELECT * FROM usuario WHERE nombre ='" . $usuarioNombre . "' AND password='" . $password . "'";
                $result = mysqli_query($this->link, $query);
                $data   = array();
                while ($data[] = mysqli_fetch_assoc($result));
                array_pop($data);
                return $data;
            }
        } else {
            return false;
        }
    }

    //Obtiene el usuario por id
    public function getID($id = null)
    {
        if (!empty($id)) {
            $query  = "SELECT * FROM tb_client WHERE subscriber=" . $id;
            $result = mysqli_query($this->link, $query);
            $data   = array();
            while ($data[] = mysqli_fetch_assoc($result));
            array_pop($data);
            return $data;
        } else {
            return false;
        }
    }

    //Obtiene el usuario por id
    public function setEditUser($data)
    {
        if (!empty($data['id'])) {
            $query  = "UPDATE Usuario SET name='" . $data['name'] . "',last_name='" . $data['last_name'] . "', email='" . $data['email'] . "' WHERE id=" . $data['id'];
            $result = mysqli_query($this->link, $query);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Borra el usuario por id
    public function deleteUser($id = null)
    {
        if (!empty($id)) {
            $query  = "DELETE FROM Usuario WHERE id=" . $id;
            $result = mysqli_query($this->link, $query);
            if (mysqli_affected_rows($this->link) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Filtro de busqueda
    public function getUsuarioBySearch($data = null)
    {
        if (!empty($data)) {
            $query  = "SELECT * FROM Usuario WHERE name LIKE'%" . $data . "%' OR last_name LIKE'%" . $data . "%' OR email LIKE'%" . $data . "%'";
            $result = mysqli_query($this->link, $query);
            $data   = array();
            while ($data[] = mysqli_fetch_assoc($result));
            array_pop($data);
            return $data;
        } else {
            return false;
        }
    }

    //Envia mail
    public function enviarMail($email, $subject, $message)
    {
        if (mail($email, $subject, $message)) {
            return true;
        } else {
            return false;
        }
    }

    //Crea un nuevo cliente
    /*public function getLog($usuarioNombre)
{
$query  = "INSERT INTO tb_client (business_name,subscriber,department,municipality) VALUES ('" . $data['business_name'] . "','" . $data['subscriber'] . "','" . $data['department'] . "','" . $data['municipality'] . "')";
$result = mysqli_query($this->link, $query);
if (mysqli_affected_rows($this->link) > 0) {
return true;
} else {
return false;
}
}*/
}
