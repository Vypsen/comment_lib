<?php

require 'Controllers/CommentController.php';

class Router
{
    static $routes = [];

    static public function get($uri, $move){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'GET' && $uri == $_SERVER['REQUEST_URI']){
            $controller = explode('@', $move)[0];
            $method = explode('@', $move)[1];
            $objectController = new $controller;
            echo $objectController->$method();
        }
        self::$routes[] = $uri;
    }

    static public function post($uri, $move){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST' && $uri == $_SERVER['REQUEST_URI']){
            $controller = explode('@', $move)[0];
            $method = explode('@', $move)[1];
            $body = json_decode(file_get_contents("php://input"));
            $objectController = new $controller;
            echo $objectController->$method($body);
        }
        self::$routes[] = $uri;
    }
}