<?php
class Usuarios{
    public $IdUsuarios = $foo;
    public $NombreUsuarios;
    public $idPerfil;
    public $EmailUsuarios;
    public $ContrasenaUsuarios;

    public function __construct($IdUsuarios, $NombreUsuarios, $idPerfil, $EmailUsuarios, $ContrasenaUsuarios)
    {
        $this->IdUsuarios = $IdUsuarios;
        $this->NombreUsuarios = $NombreUsuarios;
        $this->idPerfil = $idPerfil;
        $this->EmailUsuarios = $EmailUsuarios;
        $this->ContrasenaUsuarios = $ContrasenaUsuarios;
    }
}

class UserPermisos {
    public $IdUsuarios;
    public $NombreUsuarios;
    public $NombreModulo;
    public $insertar_der;
    public $modificar_der;
    public $eliminar_der;
    public $imprimir_der;

    public function __construct($IdUsuarios, $NombreUsuarios, $NombreModulo, $insertar_der,	$modificar_der,	$eliminar_der, $imprimir_der) {
        $this->IdUsuarios = $IdUsuarios;
        $this->NombreUsuarios = $NombreUsuarios;
        $this->NombreModulo = $NombreModulo;
        $this->insertar_der = $insertar_der;
        $this->modificar_der = $modificar_der;
        $this->eliminar_der = $eliminar_der;
        $this->imprimir_der = $imprimir_der;
    }
}

class UsuariosControl{
    public static function GetElement($where, $conn) {
        $sql = "SELECT * FROM Usuarios WHERE $where ";
        // $params = array($where);
        $stmt = sqlsrv_query($conn, $sql);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $IdUsuarios = $row['IdUsuarios'];
            $NombreUsuarios = $row['NombreUsuarios'];
            $idPerfil = $row['idPerfil'];
            $EmailUsuarios = $row['EmailUsuarios'];
            $ContrasenaUsuarios = $row['ContrasenaUsuarios'];
            $temp = new Usuarios($IdUsuarios, $NombreUsuarios, $idPerfil, $EmailUsuarios, $ContrasenaUsuarios);
            return $temp;
            
        } else {
            return null;
        }
    }

    public static function GetElementByPK($IdUsuarios, $conn) {
        $sql = "SELECT * FROM Usuarios WHERE IdUsuarios = ?";
        $params = array($IdUsuarios);
        $stmt = sqlsrv_query($conn, $sql, $params);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $IdUsuarios = $row['IdUsuarios'];
            $NombreUsuarios = $row['NombreUsuarios'];
            $idPerfil = $row['idPerfil'];
            $EmailUsuarios = $row['EmailUsuarios'];
            $ContrasenaUsuarios = $row['ContrasenaUsuarios'];
            $temp = new Usuarios($IdUsuarios, $NombreUsuarios, $idPerfil, $EmailUsuarios, $ContrasenaUsuarios);
            return $temp;
            
        } else {
            return null;
        }
    }

    public static function GetList($conn) {
        $Usuarios = [];
        $sql = "SELECT * FROM Usuarios";
        $stmt = sqlsrv_query($conn, $sql);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $IdUsuarios = $row['IdUsuarios'];
                $NombreUsuarios = $row['NombreUsuarios'];
                $idPerfil = $row['idPerfil'];
                $EmailUsuarios = $row['EmailUsuarios'];
                $ContrasenaUsuarios = $row['ContrasenaUsuarios'];
                $temp = new Usuarios($IdUsuarios, $NombreUsuarios, $idPerfil, $EmailUsuarios, $ContrasenaUsuarios);
                $Usuarios[] = $temp;
            }
            return $temp;
        } else {
            return null;
        }
    }

    public static function Login($IdUsuarios, $conn) {
        $sql = "SELECT * FROM GET_USER_PERMISOS(?)";
        $params = array($IdUsuarios);
        $stmt = sqlsrv_query($conn, $sql, $params);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $IdUsuarios = $row['IdUsuarios'];
            $NombreUsuarios = $row['NombreUsuarios'];
            $NombreModulo = $row['NombreModulo'];
            $insertar_der = $row['insertar_der'];
            $modificar_der = $row['modificar_der'];
            $eliminar_der = $row['eliminar_der'];
            $imprimir_der = $row['imprimir_der'];
            $temp = new UserPermisos($IdUsuarios,$NombreUsuarios,$NombreModulo,$insertar_der,$modificar_der,$eliminar_der,$imprimir_der);
            return $temp;
            
        } else {
            return null;
        }
    }
}
?>
