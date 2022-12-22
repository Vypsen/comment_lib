<?php

require 'Controllers/CommentController.php';

class Router
{
    static function notFound()
    {
        http_response_code(404);
        echo json_encode(array("message" => "Not Found"),JSON_UNESCAPED_UNICODE);
        die;
    }

    static public function get($uri, $move){
        $methodHTTP = $_SERVER['REQUEST_METHOD'];
        if($methodHTTP == 'GET' && $uri == $_SERVER['REQUEST_URI']){
            self::runMethod($move);
        }
    }

    static public function post($uri, $move){
        $methodHTTP = $_SERVER['REQUEST_METHOD'];
        if($methodHTTP == 'POST' && $uri == $_SERVER['REQUEST_URI']){
            $body = json_decode(file_get_contents("php://input"));
            self::runMethod($move, $body);
        }
    }

    static public function put($uri, $move){
        $methodHTTP = $_SERVER['REQUEST_METHOD'];
        if ($methodHTTP == 'PUT'){
            $uriArray = explode('/', $_SERVER['REQUEST_URI']);
            $id = $uriArray[count($uriArray) - 1];
            $uri = substr($uri, 0, -4);
            $uriWithoutId = substr($_SERVER['REQUEST_URI'], 0, -strlen($id));
            if($uri == $uriWithoutId){
                $body = json_decode(file_get_contents("php://input"));
                $body = (object) array_merge((array)$body, ['id' => $id]);
                self::runMethod($move, $body);
            }
        }
    }

    private static function runMethod($move, $body = null){
        $controller = explode('@', $move)[0];
        $method = explode('@', $move)[1];
        $objectController = new $controller;
        echo $objectController->$method($body);
        die;
    }
}