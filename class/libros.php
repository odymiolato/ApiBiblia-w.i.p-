<?php
class Libro {
    public $IdLibro;
    public $NomLibro;
    public $IdTestamento;
    public $idCategoria;
    public $CantCapLibros;

    public function __construct($IdLibro, $NomLibro, $IdTestamento, $idCategoria, $CantCapLibros) {
        $this->IdLibro = $IdLibro;
        $this->NomLibro = $NomLibro;
        $this->IdTestamento = $IdTestamento;
        $this->idCategoria = $idCategoria;
        $this->CantCapLibros = $CantCapLibros;
    }
}


include "../class/Versiculos.php";
class LibroControl {    
    public static function GetElementByPK($idLibro, $conn) {
        $sql = "SELECT * FROM libros WHERE idLibro = ?";
        $params = array($idLibro);
        $stmt = sqlsrv_query($conn, $sql, $params);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $IdLibro = $row['IdLibro'];
            $NomLibro = $row['NomLibro'];
            $IdTestamento = $row['IdTestamento'];
            $idCategoria = $row['idCategoria'];
            $CantCapLibros = $row['CantCapLibros'];
            // echo " $IdLibro  $NomLibro  $IdTestamento  $idCategoria  $CantCapLibros";
            $temp = new Libro($IdLibro, $NomLibro ,$IdTestamento ,$idCategoria, $CantCapLibros);
            return $temp;
            
        } else {
            return null;
        }
    }
    
    public static function GetCapitulos($IdLibro,$conn){
        return VersiculosControl::GetCapitulos($IdLibro,$conn);
    }

    public static function GetVersiculosCapitulos($IdLibro,$IdCapitulo,$conn){
        return VersiculosControl::GetVersiculosCapitulo($IdLibro,$IdCapitulo,$conn);
    }

    public static function GetList($conn) {
        $libros = [];
        $sql = "SELECT * FROM libros";
        $stmt = sqlsrv_query($conn, $sql);
    
        if ($stmt === false) {
            echo "Error al ejecutar la consulta.</br>";
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_has_rows($stmt)) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $IdLibro = $row['IdLibro'];
                $NomLibro = $row['NomLibro'];
                $IdTestamento = $row['IdTestamento'];
                $idCategoria = $row['idCategoria'];
                $CantCapLibros = $row['CantCapLibros'];
                // echo " $IdLibro  $NomLibro  $IdTestamento  $idCategoria  $CantCapLibros";
                $libros[] = new Libro($IdLibro, $NomLibro ,$IdTestamento ,$idCategoria, $CantCapLibros); 
            }
            return $libros;
        } else {
            return null;
        }
    }
    
}
?>
