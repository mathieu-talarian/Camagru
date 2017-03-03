<?php

define('ROOT', dirname(__DIR__));
require(ROOT . '/app/App.php');
App::load();
\Core\Debug\Debug::getInstance()->session;
\Core\Debug\Debug::getInstance()->server;

if (isset($_GET['p'])) {
    $page = $_GET['p'];
}
else {
    $page = 'posts.index';
}

$page = explode('.', $page);
$action = $page[1];
if ($page[0] == 'admin') {
    if ($page[1] == 'index') {
        $controller = '\App\Controller\Admin\AppController';
        $action = 'index';
    } else {
        $controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
        $action = $page[2];
    }
}
else {
    $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
}
$controller = new $controller();
$controller->$action();
?>