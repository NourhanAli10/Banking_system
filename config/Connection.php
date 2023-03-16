<?php
class Connection
{

    private $hostName = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "banking_system";
    public \mysqli $con;

    public function __construct()
    {
        $this->con = new \mysqli($this->hostName, $this->username, $this->password, $this->dbName);
    }


    public function __destruct()
    {
        $this->con->close();
    }
}
