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
        $comment = new Comment();
        $comment->name = $body->name;
        $comment->text = $body->text;

        $comment->create();
    }
}