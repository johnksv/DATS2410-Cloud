<?php

class Database
{
    private static $dbHost = '10.1.0.252' ;
    private static $dbUsername = 'webserver';
    private static $dbUserPassword = 'placeSundayjudge';
    private static $database = 'studentinfosys';
    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        // One connection through whole application
        if ( null == self::$cont )
        { 
               self::$cont =  new mysqli(self::$dbHost, self::$dbUsername, self::$dbUserPassword);
               self::$cont->select_db(self::$database);
            if ($conn->connect_error) {
    
                die("Connection failed: " . $conn->connect_error);
}
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont->close();
    }
}
?>
