<?php

require 'Database/Database.php';

$connection = Database::openConnection('pgsql', 5432, 'commentDB');

$sql = "SELECT * FROM comments";

$data = pg_query($connection, $sql);

$result = pg_fetch_all($data);
echo json_encode($result);