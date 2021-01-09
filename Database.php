<?php

require_once 'config.php';

class Database
{
    private static $instance = null;
    private $connection = null;

    private $username;
    private $password;
    private $host;
    private $database;

    private function __construct()
    {
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->host = HOST;
        $this->database = DATABASE;
    }

    public function connect(): PDO
    {
        if($this->connection !=  null)
        {
            return $this->connection;
        }
        try
        {
            $this->connection = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode" => "prefer"]
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;

        } catch (PDOException $error)
        {
            die("Connection failure" . $error->getMessage());
        }
    }

    public function getInstance(): Database
    {
        if(!self::$instance)
        {
            self::$instance = new Database();
        }

        return self::$instance;
    }
}