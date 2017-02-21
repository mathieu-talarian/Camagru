<?php
session_start();
require "controlers/autoloader.php";
Autoloader::register();


if (!isset($_SESSION['name'])){
  $array = array('mail' => 'mail', 'Utilisateur' => 'user', 'Mot de Passe' => 'password', 'Repeter le mot de
  Passe' => 'confirm_password');
  $ins = new Inscription($array);
  $ins = $ins->inscription();

} else {
  $array = array('Utilisateur' => 'user', 'Mot de Passe' => 'password');
  $log = new Log($array);
  $log->login();

}
