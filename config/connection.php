<?php 

class Connection{
    private static $instance;

    private function __construct(){}


    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new Connection();
        }
        return self::$instance;
    }


    public function connection(){
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "social";
        $connection = new mysqli($hostname, $username, $password, $database);
        $connection->query("set names utf8");
        return $connection;
    }
}