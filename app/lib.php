<?php

class DB {
    private $conn = null;
    private $stmt = null;
    public $lastID = null;

    function __construct () {
        // __construct() : connect to database

        //Create connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        //Check connection
        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    function __destruct () {
        // __destruct (): close connection once done

        if($this->stmt !== null ) { $this->stmt = null; }
        if($this->conn !== null ) { $this->conn = null; }
    }

    function exec ($sql, $data=null) {
         $this->stmt = $this->conn->prepare($sql);
         $this->stmt->execute($data);

         if($conn->query($sql) == FALSE) {
            $this->error = $this->conn->connect_error;
            return false;
         }
         $this->stmt = null;
         return true;
    }

    function fetchAll ($sql, $cond=null, $key=null, $value=null) {

        $result = [];

        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute($cond);

        if(isset($key)) {
            if(isset($value)) {
                if(is_callable($value)) {
                    while($row = $this->stmt->fetch_assoc()) {
                        $result[$row[$key]]  = $value($row);
                    }
                } else {
                    while($row = $this->stmt->fetch_assoc()) {
                        $result[$row[$key]] = $row[$value];
                    }
                }
            } else {
                while($row = $this->stmt->fetch_assoc()) {
                    $result[$row[$key]] = $row;
                }
            }
        } else {
            $result = $this->stmt->fetch_assoc();
        }
        $this->stmt = null;
        return count($result) == 0 ? false : $result; 
    }

    function fetch ($sql, $cond=null, $sort=null) {

        $result = [];

        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute($cond);

        if(is_callable($sort)) {
            while($row = $this->stmt->fetch_assoc()) {
                $result = $sort($row);
            }
        } else {
            while($row = $this->stmt->fetch_assoc()) {
                $result = $row;
            }
        }
    }
}