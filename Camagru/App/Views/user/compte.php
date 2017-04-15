<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 4/15/17
 * Time: 1:52 PM
 */
?>
<h1>Modification du Compte
</h1>
<div>
    <?php if(isset($errors)): ?>
        <?php foreach($errors as $error): ?>
            <?= $error; ?>
            <?php endforeach; ?>
    <?php endif; ?>
<form action="index.php?p=register.majmdp" method="post">
<?= $form->input_required('ancienmdp', 'Ancien mot de passe', ['type' => 'password']); ?>
<?= $form->input_required('nouveaumdp', 'Nouveau mot de passe', ['type' => 'password']); ?>
<?= $form->input_required('conf', 'Confirmation du mouveau passe', ['type' => 'password']); ?>
<button class="btn btn-primary">Mise a jour du mdp</button>
</form>
</div>


<form action="index.php?p=register.majpseudo" method="post">
    <?= $form->input_required('newpseudo', 'Nouveau pseudo'); ?>
    <button>Mise a jour du pseudo</button>
</form>

<form action="index.php?p=register.majname" method="post">
    <?= $form->input_required('newnom', 'Nouveau nom'); ?>
    <?= $form->input_required('newprenom', 'Nouveau prenom'); ?>
    <button>Mise a jour du nom et prenom</button>
</form>