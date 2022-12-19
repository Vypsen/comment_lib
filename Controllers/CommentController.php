<?php

require 'Comment.php';

class CommentController
{
    private function validation_fail($body)
    {
        return (empty($body->name) || empty($body->text));
    }

    function getComments()
    {
        $comments = Comment::getAll();
        return $comments;
    }

    function setComment($body)
    {
        if ($this->validation_fail($body))
        {
            http_response_code(400);
            return json_encode(array("message" => "Неполные данные."),JSON_UNESCAPED_UNICODE);
        }

        $comment = Comment::createModelFromRequest($body);

        try {
            $comment->createComment();
        } catch (Exception $e){
            return $e;
        }
        return json_encode(array("message" => "Комментарий успешно добавлен."),JSON_UNESCAPED_UNICODE);
    }

    function updateComment($body)
    {
        if ($this->validation_fail($body))
        {
            http_response_code(400);
            return json_encode(array("message" => "Неполные данные."),JSON_UNESCAPED_UNICODE);
        }

        $oldComment = Comment::get($body->id);
        if ($oldComment) {
            http_response_code(200);
            $oldComment->name = $body->name;
            $oldComment->text = $body->text;

            $oldComment->update();
        } else {
            $comment = Comment::createModelFromRequest($body);
            $comment->createComment();

            http_response_code(201);
            return json_encode(array("message" => "Комментарий успешно добавлен."),JSON_UNESCAPED_UNICODE);
        }
    }
}