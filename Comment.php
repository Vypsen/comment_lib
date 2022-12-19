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

    static function createModelFromRequest($body)
    {
        $comment = new self();
        $comment->name = $body->name;
        $comment->text = $body->text;

        return $comment;
    }

    function createComment()
    {
        self::openConnection();

        $query = "INSERT INTO  " . self::$tableName . '( name, text)' .
            " VALUES  ('{$this->name}', '{$this->text}')";

        $res = self::$connection->setData($query);

        return $res;
    }

    static function getAll()
    {
        self::openConnection();

        $query = "SELECT * FROM " . self::$tableName;
        $data = self::$connection->getData($query);

        return $data;
    }

    static function get($id)
    {
        self::openConnection();

        $query = "SELECT * FROM " . self::$tableName . " WHERE id = {$id}";

        $data = json_decode(self::$connection->getData($query));
        if (!empty($data)){
            $comment = self::createModelFromRequest($data[0]);
            $comment->id = $data[0]->id;

            return $comment;
        }
        return false;
    }

    static function delete($id)
    {
        self::openConnection();
        $query = "DELETE FROM " . self::$tableName . " WHERE id = {$id}";

        return self::$connection->setData($query);
    }

    function update()
    {
        $query = "UPDATE " . self::$tableName .
            " SET name = '{$this->name}', text = '{$this->text}' WHERE id = {$this->id}" ;

        self::$connection->setData($query);
    }
}