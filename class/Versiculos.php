<?php

class Versiculos {
    public $IdVersiculos;
    public $EmcabezadoVersiculos;
    public $TextoVersiculos;
    public $IdLibro;
    public $IdCapitulos;
     
    public function __construct($IdVersiculos,$EmcabezadoVersiculos,$TextoVersiculos,$IdLibro,$IdCapitulos) {
        $this->IdVersiculos = $IdVersiculos;
        $this->EmcabezadoVersiculos = $EmcabezadoVersiculos;
        $this->TextoVersiculos = $TextoVersiculos;
        $this->IdLibro = $IdLibro;
        $this->IdCapitulos = $IdCapitulos;
        
    }
}

class VersiculosControl {
    public static function GetElementByPK($IdVersiculos,$IdLibro,$IdCapitulos, $conn) {
        $sql = "SELECT * FROM Versiculos WHERE IdVersiculos = ? AND IdLibro = ? AND IdCapitulos = ?";
        $params = array($IdVersiculos,$IdLibro,$IdCapitulos);
        $stmt = sqlsrv_query($conn, $sql, $params);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $IdVersiculos = $row['IdVersiculos'];
            $EmcabezadoVersiculos = $row['EmcabezadoVersiculos'];
            $TextoVersiculos = $row['TextoVersiculos'];
            $IdLibro = $row['IdLibro'];
            $IdCapitulos = $row['IdCapitulos'];
            $temp = new Versiculos($IdVersiculos,$EmcabezadoVersiculos,$TextoVersiculos,$IdLibro,$IdCapitulos);
            return $temp;
            
        } else {
            return null;
        }
    }
    
    public static function GetCapitulos($IdLibro,$conn){
        $Capitulos = [];
        $sql = "SELECT IdCapitulos FROM Versiculos where IdLibro = ? group by IdCapitulos order by IdCapitulos asc";
        $params = array($IdLibro);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if($stmt === false){
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
        if (sqlsrv_has_rows($stmt)) {
             while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                $Capitulos[] = $row['IdCapitulos'];
             }   
        }
        return $Capitulos;
    }
    
    public static function GetVersiculosCapitulo($IdLibro,$IdCapitulos,$conn) {
        $libros = [];
        $sql = "SELECT * FROM Versiculos WHERE IdLibro = ? AND IdCapitulos = ?";
        $params = array($IdLibro,$IdCapitulos);
        $stmt = sqlsrv_query($conn, $sql, $params);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $IdVersiculos = $row['IdVersiculos'];
                $EmcabezadoVersiculos = $row['EmcabezadoVersiculos'];
                $TextoVersiculos = $row['TextoVersiculos'];
                $IdLibro = $row['IdLibro'];
                $IdCapitulos = $row['IdCapitulos'];
                $libros[] = new Versiculos($IdVersiculos,$EmcabezadoVersiculos,$TextoVersiculos,$IdLibro,$IdCapitulos);
            }
            return $libros;
        } else {
            return null;
        }
    }
    
    public static function GetList($conn) {
        $libros = [];
        $sql = "SELECT * FROM Versiculos";
        $stmt = sqlsrv_query($conn, $sql);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $IdVersiculos = $row['IdVersiculos'];
                $EmcabezadoVersiculos = $row['EmcabezadoVersiculos'];
                $TextoVersiculos = $row['TextoVersiculos'];
                $IdLibro = $row['IdLibro'];
                $IdCapitulos = $row['IdCapitulos'];
                $libros[] = new Versiculos($IdVersiculos,$EmcabezadoVersiculos,$TextoVersiculos,$IdLibro,$IdCapitulos);
            }
            return $libros;
        } else {
            return null;
        }
    }
    
}
?>
