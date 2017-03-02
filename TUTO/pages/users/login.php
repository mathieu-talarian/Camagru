<?php

if (!empty($_POST)) {
    $auth = new Core\Auth\DBAuth(App::getInstance()->getDB());
    if ($auth->login($_POST['username'], $_POST['password']))
        header('Location: admin.php');
    else {
        ?>
            <div class="alert alert-danger">Identifiants Incorrects</div>
        <?php
    }
}


$form = new Core\HTML\BootstrapForm($_POST);

//if (isset($_POST['username']) && isset($_POST['password'])) {
//
//}
// ?>

<form method="post">
    <?= $form->input('username', 'Pseudo'); ?>
    <?= $form->input('password', 'Mot de Passe', ['type' => 'password']); ?>
    <?= $form->submit(); ?>

</form>