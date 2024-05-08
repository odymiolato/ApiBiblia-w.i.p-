<?php
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

    include '../conexion.php';
    include "../class/libros.php";

    $conn = Connection::OpenConnection();
    $data = json_decode(file_get_contents('php://input'));
    $resultado= null;

    if(isset($data) && !empty($data)){
        $caso = $data->case;
        switch($caso){
            case 1: 
                $Idlibro = $data->Idlibro;
                $resultado = LibroControl::GetElementByPK($Idlibro,$conn);
                break;
            case 2:
                $resultado = LibroControl::GetList($conn); 
                break;
            case 3: 
                $Idlibro = $data->Idlibro;
                $resultado = LibroControl::GetCapitulos($Idlibro,$conn); 
                break;
            case 4 : 
                $Idlibro = $data->Idlibro;
                $IdCapitulo = $data->IdCapitulo;
                $resultado = LibroControl::GetVersiculosCapitulos($Idlibro,$IdCapitulo,$conn); 
                break;
        }   
    }
    
    Connection::CloseConnection($conn);
    return json_encode($resultado);
?>