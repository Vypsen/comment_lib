<?php

class Database
{
    static function openConnection($host = 'localhost', $port = 5432, $db = 'db', $user = 'user', $password = 'secret')
    {
        $connection = pg_connect("host=pgsql port={$port} dbname={$db} user={$user} password={$password}");

        return $connection;
    }
}