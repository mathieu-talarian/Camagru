<?php if ($errors): ?>

    <div class="alert alert-danger">Identifiants Incorrects</div>
<?php endif; ?>

<form method="post">
    <?= $form->input('username', 'Pseudo'); ?>
    <?= $form->input('password', 'Mot de Passe', ['type' => 'password']); ?>
    <?= $form->submit(); ?>

</form>