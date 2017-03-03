<?php

define('ROOT', dirname(__DIR__));
require(ROOT . '/app/App.php');
App::load();
\Core\Debug\Debug::getInstance()->session;
?>
coucou