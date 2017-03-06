<?php
define('ROOT', dirname(__DIR__));

require(ROOT . '/app/App.php');
App::load();

if (isset($_GET['p'])) {
    $page = $_GET['p'];
}
else {
    $page = 'posts.index';
}
//bouttons persos a rajouter dans les controllers
//App::home();
//App::admin_home();
//App::login();
//App::logout();
//

$contr = new \App\Controller\PostsController();
$contr->test();


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

<div class="core">
    <a href="index.php">Home</a>
    <a href="index.php?p=admin.index">Admin</a>
    <a href="index.php?p=users.login">login</a>
    <a href="index.php?p=users.logout">Logout</a>
</div>
