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

//Auth
$auth = new Core\Auth\DBAuth(App::getInstance()->getDB());
if (!$auth->logged()) {
    App::forbidden();
}
//fin Auth

ob_start();
App::home();
App::admin_home();
App::login();
App::logout();
//\Core\Debug\Debug::getInstance()->divvd($_SESSION);
if ($page === 'home') {
    require ROOT . '/pages/admin/posts/index.php';
}
elseif ($page=== 'post.edit') {
    require ROOT . '/pages/admin/posts/edit.php';
}
else if ($page === 'post.add') {
    require ROOT . '/pages/admin/posts/add.php';
}
$content = ob_get_clean();
require ROOT . '/pages/template/default.php';

?>