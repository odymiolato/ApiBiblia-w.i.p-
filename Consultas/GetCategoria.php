<?php
    header("content-type: aplication/json");
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

    include '../conexion.php';
    include '../class/Categoria.php';

    $conn = Connection::OpenConnection();
    $data = json_decode(file_get_contents("php://input"));
    $resultado = null;

    if(isset($data) && !empty($data)){
        $caso = $data->case;
        switch($caso){
            case 1:
                $IdCategoria = $data->IdCategoria;   
                break;
            case 2:
                $resultado = CategoriaControl::GetList($conn); 
                break;
        }
    }
        
    Connection::CloseConnection($conn);
    return $resultado;
?>