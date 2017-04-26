<?php

class Connection
{

    private static $con;
    private static $host = '10.1.0.252' ;
    private static $username = 'webserver';
    private static $password = 'placeSundayjudge';
    private static $database = 'studentinfosys';

    private function __construct()
    {
    }

    /**
     * @return \mysqli The connection to the database
     */
    public static function connect()
    {
        self::$con = new mysqli(self::$host, self::$username, self::$password);
        if (self::$con->connect_error) {
            die("connection failed: " . self::$con->connect_error);
        }
        self::$con->select_db(self::$database);

        return self::$con;
    }

    /**
     * Closes the connection to the database
     */
    public static function disconnect()
    {
        if (self::$con instanceof \mysqli) {
            self::$con->close();
        }
        self::$con = null;
    }


}
