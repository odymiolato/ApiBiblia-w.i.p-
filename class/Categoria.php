<?php
class Categoria {
    public $IdCategoria;
    public $NomCategoria;

    public function __construct($IdCategoria, $NomCategoria) {
        $this->IdCategoria = $IdCategoria;
        $this->NomCategoria = $NomCategoria;
    }
}

class CategoriaControl {
    public static function GetElementByPK($IdCategoria, $conn) {
        $sql = "SELECT * FROM Categoria WHERE idCategoria = ?";
        $params = array($IdCategoria);
        $stmt = sqlsrv_query($conn, $sql, $params);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $IdCategoria = $row['idCategoria'];
            $NomCategoria = $row['NomCategoria'];
            $temp = new Categoria($IdCategoria, $NomCategoria );
            return $temp;
            
        } else {
            return null;
        }
    }
    
    public static function GetList($conn) {
        $libros = [];
        $sql = "SELECT * FROM Categoria";
        $stmt = sqlsrv_query($conn, $sql);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $IdCategoria = $row['idCategoria'];
                $NomCategoria = $row['NomCategoria'];
                $libros[] = new Categoria($IdCategoria, $NomCategoria );
            }
            return $libros;
        } else {
            return null;
        }
    }
    
}
?>
