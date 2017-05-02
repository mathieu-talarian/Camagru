<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 5/2/17
 * Time: 2:56 PM
 */
?>


<?php if ($a === 1): ?>
<form action="" method="post">
    <?= $form->input_required('passwd', 'Nouveau mot de passe', ['type' =>'password']); ?>
    <?= $form->input_required('conf_passwd', 'Confirmez le mot de passe', ['type' => 'password']); ?>
    <button>OK</button>
</form>
<?php else: ?>
<?php if ($errors): ?>
<ul>
<?php foreach ($errors as $error): ?>
<li>
    <?= $error; ?>
</li>
<?php endforeach; ?>
</ul>

<?php endif; ?>
<?php endif; ?>
