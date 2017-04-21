<?php

class Connection
{
    private static $conn  = null;
    private static $host = '10.1.0.252' ;
    private static $username = 'webserverr';
    private static $password = 'placeSundayjudge';
    private static $database = 'studentinfosys';

    public function construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        // One connection through whole application
        if ( null == self::$conn )
        {
               self::$conn =  new mysqli(self::$host, self::$username, self::$password);
               self::$conn->select_db(self::$database);
            if (self::$conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        }
        return self::$conn;
    }

    public static function disconnect()
    {
        self::$conn->close();
        self::$conn = null;
    }
}
?>
