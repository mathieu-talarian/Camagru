<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 3/1/17
 * Time: 7:40 PM
 */
$postTable = App::getInstance()->getTable('post');
if (!empty($_POST)) {
    $postTable->update($_GET['id'],
        [
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu']
        ]);
}
$post = $postTable->find($_GET['id']);
$form = new \Core\HTML\BootstrapForm($post);

?>

<h1>Mon menu d'edition</h1>

<form action="" method="post">
    <?= $form->input('titre', 'titre de l\'article'); ?>
    <?= $form->input('contenu', 'Content', ['type' => 'textarea']); ?>
    <button class="btn btn-primary">Editer</button>
</form>


