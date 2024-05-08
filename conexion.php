<?php
class Connection
{
    static function OpenConnection()
    {

        $serverName = "Developer-16"; //serverName\instanceName, portNumber (default is 1433)
        $connectionInfo = array("Database" => "CCCPCasaDePazReal", "TrustServerCertificate"=>"true");
        // $connectionInfo = array("Database" => "CCCPCasaDePaz", "UID" => "dev", "PWD" => "amdin1234", "TrustServerCertificate"=>"true");
        $conn = sqlsrv_connect($serverName, $connectionInfo);

        if ($conn) {
            // echo "Connection established.<br />";
        } else {
            echo "Connection could not be established.<br />";
            die(print_r(sqlsrv_errors(), true));
        }
        return $conn;
    }

    static function CloseConnection($con)
    {
        sqlsrv_close($con);
    }
}
