# composer lib comment

## Instruction
1. run `composer require vypsen/comment-lib "master-dev"`
2. run `$ cd vendor/vypsen/comment-lib`
3. run `$ docker-compose up -d`
4. for tests run `$ docker exec -it comment-lib_php_1  bash` and `./vendor/bin/phpunit Tests/CommentTest.php`