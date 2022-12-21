<?php

require __DIR__ . '/vendor/autoload.php';
require 'Router.php';
header('Content-type: application/json; charset=utf-8');

Router::get('/comments', 'CommentController@getComments');

Router::post('/comment', 'CommentController@setComment');

Router::put('/comment/{id}', 'CommentController@updateComment');