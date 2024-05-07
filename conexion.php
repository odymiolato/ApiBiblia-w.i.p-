<?php
class Connection{
    static function OpenConnection()
     {
         $serverName = "DEV-06";
         $connectionOptions = array("Database"=>"CCCPCasaDePazReal");
         $conn = sqlsrv_connect($serverName, $connectionOptions);
         if($conn == false){
             die("No se pudo conectar");
         } 
         return $conn;   
     }
 
     static function CloseConnection($con)
     {
         sqlsrv_close($con);
     }
 }
?>