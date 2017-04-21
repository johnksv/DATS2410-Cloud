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
            try
            {
                self::$cont =  new mysqli(self::$dbHost, self::$dbUsername);
            }
            catch(PDOException $e)
            {
                die("Connection failed: " . self::$cont->connect_error);
            }
            $conn->select_db($database);
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont->close();
    }
}
?>
