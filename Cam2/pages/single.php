<?php


use App\App;

$post = App::getDB()->prepare('SELECT * from articles WHERE id= ?', [$_GET['id']], 'App\Table\Article', true);
?>


<h1><?= $post->titre; ?></h1>


<p><?= $post->contenu; ?></p>
