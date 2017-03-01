<?php
use App\Autoloader;
use App\Config;

error_reporting(-1);
session_start();
require('../app/Autoloader.php');

Autoloader::register();


echo '<body><div><a href="index.php?p=home">Go back home</a></div></body>';


?>
