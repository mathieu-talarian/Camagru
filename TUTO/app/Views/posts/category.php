<h1><?= $categorie->titre ;?></h1>

    <?php if (!empty($articles)) {
    ?>
    <div class="col-sm-8">

        <?php
        foreach ($articles as $post): ?>


            <h2><a href=" <?= $post->url; ?>"><?= $post->titre ?></a></h2>
            <p><em><?= $post->categorie; ?></em></p>

            <p><?= $post->extrait; ?></p>

        <?php endforeach; ?>
    </div>
<?php }
else { ?>
<div class="col-sm-8">
    <p>Aucun article dans cette categorie</p>
</div>
<?php } ?>
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

