<?php if ($errors): ?>
    <?php if ($errors === 1): ?>
        <div style="color: red;">Champs incomplets</div>
        <?php endif ?>

    <?php if ($errors === 2): ?>
        <div style="color: red;">Pseudo Existant</div>
    <?php endif ?>

    <?php if ($errors === 3): ?>
        <div style="color: red;">Mail non reconnu</div>
    <?php endif ?>

    <?php if ($errors === 4): ?>
        <div style="color: red;">deux passwords ne correspondent pas</div>
    <?php endif ?>
<?php endif ?>

<h1>Inscription</h1>

<form action="" method="post">
    <?= $form->input('nom', 'Nom'); ?>
    <?= $form->input('prenom', 'Prenom'); ?>
    <?= $form->input('pseudo', 'Pseudo'); ?>
    <?= $form->input('mail', 'e-mail'); ?>
    <?= $form->input('passwd', 'Mot de passe', ['type' => 'password']); ?>
    <?= $form->input('passwd-verif', 'Repetez le mot de passe', ['type' => 'password']); ?>

    <button class="btn btn-primary">Submit</button>
</form>
