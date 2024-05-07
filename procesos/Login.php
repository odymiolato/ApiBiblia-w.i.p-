<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

include '../conexion.php';
include '../class/Usuarios.php';

function retornar($Connection,$conn,$resultado) {
    $Connection::CloseConnection($conn);
    echo json_encode($resultado);
    return;
}

$Connection = new Connection;
$conn = $Connection::OpenConnection();
$data = json_decode(file_get_contents("php://input"));
$resultado = null;

try {
    // if(isset($data) && !empty($data)){
    //     $NombreUsuarios = $data->NombreUsuarios;
    //     if(!preg_match("/'/",$NombreUsuarios)){
    //         $where = "NombreUsuarios = '$NombreUsuarios'";
    //         $ContrasenaUsuarios = $data->ContrasenaUsuarios;
    //         if(!empty($usuario = UsuariosControl::GetElement($where,$conn))){
    //             if(md5($ContrasenaUsuarios) == $usuario->ContrasenaUsuarios){
    //                 $resultado = UsuariosControl::Login($usuario->IdUsuarios,$conn);
    //             }else{
    //                 $resultado = 502;
    //             }
    //         }else{
    //             $resultado = 501;
    //         }        
    //     }else{
    //         $resultado = 500;
    //     }
    // }

    if (!isset($data) && empty($data)) {
        $resultado = 499;
        retornar($Connection,$conn,$resultado);
        return;
    }

    $NombreUsuarios = $data->NombreUsuarios;
    $where = "NombreUsuarios = '$NombreUsuarios'";
    $ContrasenaUsuarios = $data->ContrasenaUsuarios;


    if (preg_match("/'/", $NombreUsuarios)) {
        $resultado = 500;
        retornar($Connection,$conn,$resultado);
        return;
    }


    if (empty($usuario = UsuariosControl::GetElement($where, $conn))) {
        $resultado = 501;
        retornar($Connection,$conn,$resultado);
        return;
    }


    if (md5($ContrasenaUsuarios) != $usuario->ContrasenaUsuarios) {
        $resultado = 502;
        retornar($Connection,$conn,$resultado);
        return;
    }

    $resultado = UsuariosControl::Login($usuario->IdUsuarios, $conn);
    retornar($Connection,$conn,$resultado);
    
} catch (\Throwable $th) {
}
