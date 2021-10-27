<?php

namespace core;

use mysqli;

class Database
{
    private static ?Database $instance = null;
    private $server = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME; 
    private $port = DB_PORT;

    protected mysqli $con;

    private function __construct() {
        try {
            $this->con = mysqli_connect($this->server, $this->username, $this->password, $this->dbname, $this->port);
            mysqli_query($this->con, 'SET NAMES "UTF8"');
        } catch (\Exception $e) {
            exit('Could not connect to any database servers');
        }
    }

    public function __destruct()
    {
        //mysqli_close($this->con);
        self::$instance = null;
    }

    public static function instance(): Database
    {
        if (self::$instance == null) 
        {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public static function connection(): mysqli
    {
        return self::instance()->con;
    }
}