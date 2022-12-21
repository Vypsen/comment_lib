<?php


class Rules
{
    static public function validation_fail($body)
    {
        return (empty($body->name) || empty($body->text));
    }
}