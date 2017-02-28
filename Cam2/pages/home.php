<?php

use App\Table\Article;

foreach (Article::getLast() as $post): ?>

    <h2><a href=" <?= $post->url; ?>"><?= $post->titre ?></a></h2>
    <p><?= $post->extrait; ?></p>

 <?php endforeach; ?>

