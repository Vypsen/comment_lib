<?php
require 'Database/Database.php';

class Comment
{
    static private Database $connection;
    static private $tableName = "comments";

    public $id;
    public $name;
    public $text;

    private static function openConnection()
    {
        self::$connection = new Database('pgsql', 5432, 'commentDB');
        self::$connection->openConnection();
    }

    function create()
    {
        self::openConnection();

        $query = "INSERT INTO" . self::$tableName . "
            VALUE ( 
                name=:name, text=:text )";

        $data = self::$connection->getData($query);

        return $data;

    }

    static function getAll()
    {
        self::openConnection();

        $query = "SELECT * FROM " . self::$tableName;
        $data = self::$connection->getData($query);

        return $data;
    }
}