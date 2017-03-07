<?php if ($errors): ?>
<div style="color:red;">
    Des erreurs ont ete rencontrees
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= $error ; ?></li>
        <?php endforeach; ?>
        </ul>
        </div>
<?php endif; ?>

<h1>Inscription</h1>

<form action="" method="post">
    <?= $form->input_required('nom', 'Nom'); ?>
    <?= $form->input_required('prenom', 'Prenom'); ?>
    <?= $form->input_required('pseudo', 'Pseudo'); ?>
    <?= $form->input_required('mail', 'e-mail', ['type' => 'email']); ?>
    <?= $form->input_required('passwd', 'Mot de passe', ['type' => 'password']); ?>
    <?= $form->input_required('passwd-verif', 'Repetez le mot de passe', ['type' => 'password']); ?>

    <button class="btn btn-primary">Submit</button>
</form>
