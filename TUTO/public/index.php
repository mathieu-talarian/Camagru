<?php

define('ROOT', dirname(__DIR__));

require(ROOT . '/app/App.php');
App::load();
App::home();
if (!isset($_SESSION['admin'])) {
    App::getInstance()->install_admin();
    \Core\Debug\Debug::getInstance()->vd($_SESSION);
}

if (isset($_GET['p'])) {
    $page = $_GET['p'];
}
else {
    $page = 'home';
}

ob_start();
if ($page === 'home') {
    require ROOT . '/pages/posts/home.php';
}
else if ($page === 'install.admin') {
    require_once(ROOT . '/config/install.php');
}
elseif ($page=== 'posts.single') {
    require ROOT . '/pages/posts/single.php';
}
else if ($page=== 'posts.category') {
    require ROOT . '/pages/posts/category.php';
}
else if ($page=== 'login') {
    require ROOT . '/pages/users/login.php';
}
$content = ob_get_clean();
require ROOT . '/pages/template/default.php';

?>
