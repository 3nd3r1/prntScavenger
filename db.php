<?php

//Database
class database extends PDO
{
    const PARAM_host = "localhost";
    const PARAM_usr = "root";
    const PARAM_pass = "";
    const PARAM_db = "prnt";
    const PARAM_unix_socket = "/run/mysqld/mysqld.sock";

    public function __construct($options=null)
    {
        parent::__construct('mysql:host='.database::PARAM_host.';dbname='.database::PARAM_db.';unix_socket='.database::PARAM_unix_socket, database::PARAM_usr,database::PARAM_pass, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
        ));
    }

    public function runQuery($query)
    { 
        //SQLi secured values
        $args = func_get_args();
        array_shift($args); 

        $response = parent::prepare($query);
        $response->execute($args);
        return $response;

    }
}
$db = new database();

?>
