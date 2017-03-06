<?php

$pdo = new PDO("mysql:dbname=camagru;host=localhost", 'root', 'root');
$pdo->exec("SELECT * from user");
var_dump($pdo);
?>
