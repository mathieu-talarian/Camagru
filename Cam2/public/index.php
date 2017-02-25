<?php

session_start();
require('../app/Autoloader.php');

\App\Autoloader::register();
$db = new \App\Setupdb;
$db->createdb("mmoullec", "");
$dbh = $db->get_dbh();

echo '<a href="index.php?p=home">Go back home</a></br>';

var_dump($_POST);

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
else if ($p === 'signin') {
  require ('../pages/signin.php');
}
$content = ob_get_clean();
require ('../pages/Template/default.php');

?>
