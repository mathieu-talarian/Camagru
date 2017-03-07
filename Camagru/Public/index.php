<?php

define('ROOT', dirname(__DIR__));
require(ROOT . '/app/App.php');
App::load();

if (isset($_GET['p'])) {
    $page = $_GET['p'];
}
else {
    $page = 'home.index';
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

try{
    new Exception('alors');
    new $controller;
} catch (Exception $e) {
    \Core\Debug\Debug::getInstance()->vd($e);
    $tt = new \App\Controller\AppController();
    $tt->eeeeee();
}
//$controller->$action();

?>
<hr>
<form action="index.php" method="get">
    <input type="hidden" value="">
    <button type="submit">Index</button>
</form>



<form action="index.php" method="get">
    <input type="hidden" name="p" value="home.restart_session">
    <button type="submit" style="color: red">RESTART SESSION</button>
</form>

<hr>
<p>Debug</p>
<?php
\Core\Debug\Debug::getInstance()->session;

?>