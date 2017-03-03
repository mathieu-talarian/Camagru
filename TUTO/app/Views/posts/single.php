<h1><?= $article->titre; ?></h1>

<em>
    <?php

    if($article->categorie) {
    echo $article->categorie;
    }
    ?>
</em>


<p><?= $article->contenu; ?></p>
