<?php
session_start();
require "controlers/autoloader.php";
Autoloader::register();

/*
echo 'rewrite module</br>';
if (in_array('mod_rewrite', apache_get_modules())) {
    echo "Yes, Apache supports mod_rewrite.";
}

else {
    echo "Apache is not loading mod_rewrite.";
}
echo '</br>====</br>';
*/

$caller = new Caller();
$uri = $caller::get_uri();
echo 'uri ====> ' . $uri;
echo '</br>';
echo '</br>';
echo '</br>';
if (!is_string($uri)) {
  echo '404 error</br>';
  exit;
}
else {
  echo 'Parse uri </br>';
}
if (!isset($_SESSION['name'])){
  $array = array('mail' => 'mail', 'Utilisateur' => 'user', 'Mot de Passe' => 'password', 'Repeter le mot de
  Passe' => 'confirm_password');
  $head = new Header();
  $head->afficher();
  $ins = new Inscription($array);
  $ins = $ins->inscription();
//  $foot = new Foot();
}

else {
  $array = array('Utilisateur' => 'user', 'Mot de Passe' => 'password');
  $log = new Log($array);
  $log->login();
}

?>
