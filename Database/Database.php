<?php

class Database
{
    private $connection;
    private $host, $port, $db, $user, $password;
    public function __construct($host = 'localhost', $port = 5432, $db = 'db', $user = 'user', $password = 'secret')
    {
        $this->host = $host;
        $this->port = $port;
        $this->db = $db;
        $this->user = $user;
        $this->password = $password;
    }

    function openConnection()
    {
        $this->connection = pg_connect("host={$this->host} port={$this->port} dbname={$this->db} user={$this->user} password={$this->password}");
    }

    private function getQuery($sql)
    {
        $query = pg_query($this->connection, $sql);

        return $query;
    }

    function getData($sql)
    {
        $query = $this->getQuery($sql);
        $result = pg_fetch_all($query);

        return json_encode($result);
    }

    function setData($sql)
    {
        $query = $this->getQuery($sql);
        return $query;
    }
}