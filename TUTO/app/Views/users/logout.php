<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 02/03/2017
 * Time: 02:28
 */

$log = new Core\Auth\DBAuth(App::getInstance()->getDB());
$log->logout();
header('Location: index.php');