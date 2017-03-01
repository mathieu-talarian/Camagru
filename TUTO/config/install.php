<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 01/03/2017
 * Time: 00:44
 */

$app = App::getInstance();
$app->getDB()->exec(Core\Install::getInstance()->admin());
$_SESSION['admin'] = 'on';
//App::getInstance()->getDB()->exec(Core\Install::getInstance()->admin());

echo 'admin installed';
App::home();

?>