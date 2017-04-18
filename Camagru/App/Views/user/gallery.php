<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 14/04/2017
 * Time: 17:36
 */
if (isset($errors) && $errors) {
    foreach ($errors as $error) {
        echo $error;
    }
}

if (isset($images) && $images) {
    ?>
<div id="comm" class="comm">
    <form action="index.php?p=commentaire.post_comm" method="post">
        <?= $form->input('photo_id', '', ['type' =>'hidden']); ?>
        <?= $form->input('comm', 'Commenter', ['type' =>'textarea']); ?>
        <button class="btn">commenter</button>
    </form>
</div>

    <script src="Public/js/gallery.js"></script>
    <?php
}
else {
    ?>
    <h>Pas de photos</h>
<?php
}
?>

