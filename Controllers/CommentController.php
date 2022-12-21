<?php

require_once('Models/Comment.php');
require_once('Rules/Rules.php');

class CommentController
{
    public function getComments()
    {
        $comments = Comment::getAll();
        return $comments;
    }

    public function setComment($body)
    {
        if (Rules::validation_fail($body))
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
        http_response_code(200);
        return json_encode(array("message" => "Комментарий успешно добавлен."),JSON_UNESCAPED_UNICODE);
    }

    public function updateComment($body)
    {
        if (Rules::validation_fail($body))
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