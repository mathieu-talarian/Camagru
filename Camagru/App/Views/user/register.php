<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 3/7/17
 * Time: 6:03 PM
 */
?>

<?php if (!isset($errors)): ?>
    <div>
        <h1>Un mail vous a ete envoye</h1>
        <p>veuillez cliquer sur le lien dans ce mail pour confirmer votre compte</p>
    </div>
<?php endif; ?>

<?php if (isset($errors)): ?>
    <div>
        <h1><?= $errors; ?></h1>
    </div>
<?php endif; ?>