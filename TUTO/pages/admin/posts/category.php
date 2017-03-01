<?php

use Core\Debug\Debug;

$categorie = App::getInstance()->getTable('category')->find($_GET['id']);
if ($categorie === false) {
    App::notFound();
}
$articles = App::getInstance()->getTable('post')->LastbyCategory($_GET['id']);
$categories = App::getInstance()->getTable('category')->all();
?>

<h1><?= $categorie->titre ;?></h1>
<div class="row">

    <div class="col-sm-8">

        <?php
        foreach ($articles as $post): ?>


            <h2><a href=" <?= $post->url; ?>"><?= $post->titre ?></a></h2>
            <p><em><?= $post->categorie; ?></em></p>

            <p><?= $post->extrait; ?></p>

        <?php endforeach; ?>
    </div>
</div>

<div class="col-sm-4">
    <ul>
        <?php
        foreach (App::getInstance()->getTable('category')->all() as $categorie): ?>
            <li>
                <a href="<?= $categorie->url;?>"><?= $categorie->titre ?></a>
            </li>


        <?php endforeach;?>
    </ul>
</div>

