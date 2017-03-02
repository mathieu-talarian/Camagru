<?php



$ret = App::getInstance()->getTable('post')->findWithCategory($_GET['id']);

if ($ret === null) {
    echo 'not_found';
}
?>



<h1><?= $ret->titre; ?></h1>

<em>
    <?php

    if($ret->categorie) {
    echo $ret->categorie;
    }
    ?>
</em>


<p><?= $ret->contenu; ?></p>
