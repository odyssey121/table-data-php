<?php


class Db
{
    protected $base;
    protected $user;
    protected $password;
    protected $host;
    public $conn;

    public function __construct()
    {
        $this->base = getenv('POSTGRES_DB');
        $this->user = getenv('POSTGRES_USER');
        $this->password = getenv('POSTGRES_PASSWORD');
        $this->host = getenv("POSTGRES_DB_HOST");
        try {
            $dsn = "pgsql:host=$this->host;port=5432;dbname=$this->base;user=$this->user;password=$this->password";
            $this->conn = new PDO($dsn);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getConnect()
    {
        return $this->conn;
    }
}