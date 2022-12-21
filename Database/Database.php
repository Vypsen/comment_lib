<?php

class Database
{
    private $connection;
    private $host, $port, $db, $user, $password;
    public function __construct()
    {
        $this->host = 'pgsql';
        $this->port = 5432;
        $this->db = 'commentDB';
        $this->user = 'user';
        $this->password = 'secret';

        try {
            $this->connection = pg_connect("host={$this->host} port={$this->port} dbname={$this->db} user={$this->user} password={$this->password}");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return false|PgSql\Connection
     */
    public function connection(): \PgSql\Connection|bool
    {
        return $this->connection;
    }

    private function getQuery($sql)
    {
        $query = pg_query($this->connection(), $sql);

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