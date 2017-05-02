<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 5/2/17
 * Time: 10:59 AM
 */
?>

<?php if (isset($errors)): ?>
    <div style="color:red; width: 100%; height: 10%; text-align: center">
        Des erreurs ont ete rencontrees
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>
<div>
<?php if($a === 1): ?>
    <form action="#" method="post">
        <?= $form->input_required('mail', 'Please enter your mail', ['type' => 'email']); ?>
        <button class="btn btn-primary">Mise a jour du mot de passe</button>
    </form>

<?php else: ?>

<?endif; ?>
    </div>

<?php if($a === 0): ?>
    <h1>Un mail de reinitialisation vous a ete envoye</h1>
<?php endif; ?>
