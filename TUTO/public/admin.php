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
if ($page === 'home') {
    require ROOT . '/pages/admin/index.php';
}
else if ($page === 'post.index') {
    require ROOT . '/pages/admin/posts/index.php';
}
elseif ($page=== 'post.edit') {
    require ROOT . '/pages/admin/posts/edit.php';
}
else if ($page === 'post.add') {
    require ROOT . '/pages/admin/posts/add.php';
}
else if ($page === 'post.delete') {
    require ROOT . '/pages/admin/posts/delete.php';
}
else if ($page === 'categories.index') {
    require ROOT . '/pages/admin/categories/index.php';
}
elseif ($page=== 'categories.edit') {
    require ROOT . '/pages/admin/categories/edit.php';
}
else if ($page === 'categories.add') {
    require ROOT . '/pages/admin/categories/add.php';
}
else if ($page === 'categories.delete') {
    require ROOT . '/pages/admin/categories/delete.php';
}
$content = ob_get_clean();
require ROOT . '/pages/template/default.php';

?>