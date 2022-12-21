<?php

require_once('Database/Database.php');

class Comment
{
    static public Database $db;
    static private $tableName = "comments";

    public $id;
    public $name;
    public $text;

    public function __construct()
    {
        self::openConnection();
    }

    static public function openConnection()
    {
        self::$db = new Database();
        return true;
    }

    static function createModelFromRequest($body)
    {
        $comment = new self();
        $comment->name = $body->name;
        $comment->text = $body->text;

        return $comment;
    }

    public function createComment()
    {

        $query = "INSERT INTO  " . self::$tableName . '( name, text)' .
            " VALUES  ('{$this->name}', '{$this->text}')";

        $res = self::$db->setData($query);

        return $res;
    }

    static function getAll()
    {
        self::openConnection();

        $query = "SELECT * FROM " . self::$tableName;
        $data = self::$db->getData($query);

        return $data;
    }

    static function get($id)
    {
        self::openConnection();

        $query = "SELECT * FROM " . self::$tableName . " WHERE id = {$id}";

        $data = json_decode(self::$db->getData($query));
        if (!empty($data)) {
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

        return self::$db->setData($query);
    }

    public function update()
    {
        $query = "UPDATE " . self::$tableName .
            " SET name = '{$this->name}', text = '{$this->text}' WHERE id = {$this->id}";

        self::$db->setData($query);
    }
}