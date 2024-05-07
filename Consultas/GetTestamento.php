<?php
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

    include '../conexion.php';
    include '../class/Testamento.php';

    $conn = Connection::OpenConnection();
    $data = json_decode(file_get_contents("php://input"));
    $resulrato = null;

    if(isset($data) && !empty($data)){
        $caso = $data->case;
        switch($caso){
            case 1:
                $IdTestamento = $data-> IdTestamento;
                $resuldato = TestamentoControl::GetElementByPK($IdTestamento,$conn);
                break;
            case 2:
                $resuldato = TestamentoControl::GetList($conn);
                break;
        }
    }
    
    Connection::CloseConnection($conn);
    return print_r(json_encode($resuldato));
?>