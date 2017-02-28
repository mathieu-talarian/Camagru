<?php
use App\Autoloader;

error_reporting(-1);
session_start();
require('../app/Autoloader.php');

Autoloader::register();

/*
 * Initialisation de la database;
 */


echo '<a href="index.php?p=home">Go back home</a></br>';


if (isset($_GET['p'])) {
  $p = $_GET['p'];
}
 else {
   $p = 'home';
 }


ob_start();
if ($p === 'home') {
  require ('../pages/home.php');
}
else if ($p === 'login') {
  require ('../pages/login.php');
}
else if ($p === 'article') {
  require ('../pages/single.php');
}
else if ($p === 'signin') {
  require ('../pages/signin.php');
}
$content = ob_get_clean();
require ('../pages/Template/default.php');

?>
