<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 14/04/2017
 * Time: 17:36
 */

if (isset($images) && $images) {
    ?>
    <script src="Public/js/gallery.js"></script>
    <?php
}
else {
    ?>
    <h>Pas de photos</h>
<?php
}
?>


<div id="comm" class="comm">
    <form action="index.php?p=user.comment" method="post">
        <?= $form->input('comm', 'Commenter', ['type' =>'textarea']); ?>
        <button class="btn">commenter</button>
    </form>
</div>
