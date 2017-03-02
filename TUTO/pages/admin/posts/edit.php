<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 3/1/17
 * Time: 7:40 PM
 */

$result = false;
$postTable = App::getInstance()->getTable('post');
if (!empty($_POST)) {
    $result = $postTable->update($_GET['id'],
        [
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu'],
                'categorie_id' => $_POST['categorie_id']
        ]);
}
if ($result) {
    ?>
    <div class="alert alert-success">L'article à bien été modifié</div>
<?php
}
$post = $postTable->find($_GET['id']);
$categorie = App::getInstance()->getTable('category')->extract_list('id', 'titre');
$form = new \Core\HTML\BootstrapForm($post);

?>

<h1>Mon menu d'edition</h1>

<form action="" method="post">
    <?= $form->input('titre', 'titre de l\'article'); ?>
    <?= $form->input('contenu', 'Content', ['type' => 'textarea']); ?>
    <?= $form->select('categorie_id', 'Catégorie', $categorie); ?>
    <button class="btn btn-primary">Editer</button>
</form>


