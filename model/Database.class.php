<?php
class Database
{
    private $host; //servidor
    private $username; //nome do usuário
    private $password; //senha
    private $database; //nome da base de dados
    private $connection;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connect();
    }

    //Faz a conexão com o banco de dados
    private function connect()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        } 
    }

    //Retorna o resultado da consulta
    public function query($sql)
    {
        return $this->connection->query($sql);
    }

    //Fecha a conexão com o banco de dados.
    public function close()
    {
        $this->connection->close();
    }  
}
?>