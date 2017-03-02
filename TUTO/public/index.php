<?php
define('ROOT', dirname(__DIR__));

require(ROOT . '/app/App.php');
App::load();

if (isset($_GET['p'])) {
    $page = $_GET['p'];
}
else {
    $page = 'home';
}

ob_start();
App::home();
App::admin_home();
App::login();
App::logout();
\Core\Debug\Debug::getInstance()->divvd($_SESSION);
\Core\Debug\Debug::getInstance()->divvd($_POST);
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
else if ($page=== 'logout') {
    require ROOT . '/pages/users/logout.php';
}
$content = ob_get_clean();
require ROOT . '/pages/template/default.php';

?>
