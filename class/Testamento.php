<?php
class Testamento {
    public $IdTestamento;
    public $NomTestamento;

    public function __construct($IdTestamento, $NomTestamento) {
        $this->IdTestamento = $IdTestamento;
        $this->NomTestamento = $NomTestamento;
    }
}

class TestamentoControl {
    public static function GetElementByPK($IdTestamento, $conn) {
        $sql = "SELECT * FROM Testamento WHERE IdTestamento = ?";
        $params = array($IdTestamento);
        $stmt = sqlsrv_query($conn, $sql, $params);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $IdTestamento = $row['IdTestamento'];
            $NomTestamento = $row['NomTestamento']; 
            $temp = new Testamento($IdTestamento, $NomTestamento );
            return $temp;
            
        } else {
            return null;
        }
    }
    
    public static function GetList($conn) {
        $libros = [];
        $sql = "SELECT * FROM Testamento";
        $stmt = sqlsrv_query($conn, $sql);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $IdTestamento = $row['IdTestamento'];
                $NomTestamento = $row['NomTestamento'];
                $libros[] = new Testamento($IdTestamento, $NomTestamento );
            }
            return $libros;
        } else {
            return null;
        }
    }
    
}
?>
