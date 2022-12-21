<?php

use PHPUnit\Framework\TestCase;

require_once('Models/Comment.php');
require_once('Database/Database.php');
require_once('Controllers/CommentController.php');

class CommentTest extends TestCase
{
    private $comment;
    private $name = 'test_name';
    private $text = 'test_text';
    protected function setUp(): void
    {
        $name = 'test_name';
        $text = 'test_text';

        $this->comment = new Comment();
        $this->comment->name = $name;
        $this->comment->text = $text;
    }

    public function testNotValidBodyRequestComment()
    {
        $expectation = true;
        $testBodyOnlyName = (object) array('name' => $this->name);
        $testBodyOnlyText = (object) array('text' => $this->text);

        $this->assertSame($expectation, (Rules::validation_fail($testBodyOnlyName)
                                    && Rules::validation_fail($testBodyOnlyText)));
    }

    public function testValidBodyRequestComment()
    {
        $expectation = false;
        $testBody = (object) array('name' => $this->name, 'text' => $this->text);

        $this->assertSame($expectation, Rules::validation_fail($testBody));
    }

    public function testCreateModelComment()
    {
        $testBody = (object) array('name' => $this->name, 'text' => $this->text);

        $comment = Comment::createModelFromRequest($testBody);

        $this->assertSame($comment->name, $testBody->name);
        $this->assertSame($comment->text, $testBody->text);
    }

    public function testOpenConnection()
    {
        $this->assertTrue(Comment::openConnection());
    }


}