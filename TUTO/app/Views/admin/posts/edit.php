<h1>Mon menu d'edition</h1>

<form action="" method="post">
    <?= $form->input('titre', 'titre de l\'article'); ?>
    <?= $form->input('contenu', 'Content', ['type' => 'textarea']); ?>
    <?= $form->select('categorie_id', 'Catégorie', $categorie); ?>
    <button class="btn btn-primary">Editer</button>
</form>
