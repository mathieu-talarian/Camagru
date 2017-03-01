<?php

use Core\Auth\DBAuth;

define('ROOT', dirname(__DIR__));
require(ROOT . '/app/App.php');
App::load();
$app = App::getInstance();


if (isset($_GET['p'])) {
    $page = $_GET['p'];
}
else {
    $page = 'home';
}

//Auth

$auth = new DBAuth($app->getDB());
if (!$auth->logged()) {
    App::forbidden();
}


//fin Auth



//load bouttons & page home
$app->install_admin();
App::home();
//fin load


ob_start();
if ($page === 'home') {
    require ROOT . '/pages/admin/posts/index.php';
}
elseif ($page=== 'posts.single') {
    require ROOT . '/pages/admin/posts/single.php';
}
else if ($page=== 'posts.category') {
    require ROOT . '/pages/admin/posts/category.php';
}
$content = ob_get_clean();
require ROOT . '/pages/template/default.php';

?>