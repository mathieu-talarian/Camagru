<?php


use App\App;
use App\Table\Article;
use App\Table\Categorie;

$post = Article::find($_GET['id']);

if ($post === null) {
    App::notFound();
}
?>



<h1><?= $post->titre; ?></h1>

<em>
    <?php

    if($post->categorie) {
    echo $post->categorie;
    }
    ?>
</em>


<p><?= $post->contenu; ?></p>
