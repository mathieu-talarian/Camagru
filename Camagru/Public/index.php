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

App::getController()->URL($page);
?>
<div style="display: flex;flex-direction: column">
    <div><p>Debug</p></div>
    <div>
<?php

\Core\Debug\Debug::getInstance()->vd();

?>
    </div>
    <div>
    <form action="index.php" method="get">
        <input type="hidden" name="p" value="home.restart_session">
        <button type="submit" style="color: red">RESTART SESSION</button>
    </form>
    </div>
</div>