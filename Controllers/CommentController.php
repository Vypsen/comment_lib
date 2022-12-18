<?php

require 'Comment.php';

class CommentController
{
    function getComments()
    {
        $comments = Comment::getAll();
        return $comments;
    }

    function setComment($body)
    {
        if (empty($body->name) || empty($body->text))
        {
            http_response_code(400);
            return json_encode(array("message" => "Неполные данные."),JSON_UNESCAPED_UNICODE);
        }

        $comment = new Comment();
        $comment->name = $body->name;
        $comment->text = $body->text;

        try {
            $comment->create();
        } catch (Exception $e){
            return $e;
        }
        return json_encode(array("message" => "Комментарий успешно добавлен."),JSON_UNESCAPED_UNICODE);
    }

    function updateComment($body)
    {
        $oldComment = Comment::get($body->id);
        if ($oldComment) {
            http_response_code(200);
            $oldComment->name = $body->name;
            $oldComment->text = $body->text;

            $oldComment->update();

        } else {
            http_response_code(201);
            $this->setComment($body);
        }
    }
}