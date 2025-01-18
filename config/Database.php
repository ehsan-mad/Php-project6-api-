<?php

namespace config;
use mysqli;

class Database{
    private $host = "localhost";
    private $userName = "root";
    private $password = "";
    private $dbName="task_app";
    private $conn ;
    public function __construct(){
        $this->conn=new mysqli($this->host,$this->userName,$this->password,$this->dbName);

        if($this->conn->connect_error){
            die(json_encode(["error Message " => " this is a error."]));
        }
        return $this->conn;
    }

    public function getConnection(){
        return $this->conn;
    }
}