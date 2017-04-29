<?php

class Connection
{

    private static $con;
    private static $host = 'localhost' ;
    private static $username = 'root';
    private static $password = '';
    private static $database = 'studentinfosys';

    public function __construct()
    {
    }

    /**
     * @return \mysqli The connection to the database
     */
    public function connect()
    {
        self::$con = new mysqli(self::$host, self::$username, self::$password);
        if (self::$con->connect_error) {
            die("connection failed: " . self::$con->connect_error);
        }
        self::$con->select_db(self::$database);

        return self::$con;
    }
}
