<?php

$form = new Core\HTML\BootstrapForm($_POST);
 ?>

<form method="post">
    <?= $form->input('username'); ?>
    <?= $form->input('password'); ?>
    <?= $form->submit(); ?>

</form>