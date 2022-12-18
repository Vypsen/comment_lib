<?php

require 'Router.php';

Router::get('/comments', 'CommentController@getComments');

Router::post('/comment', 'CommentController@setComment');