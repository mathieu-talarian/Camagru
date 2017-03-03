<h1>Administrer les Categories</h1>

<p>
    <a href="?p=admin.categories.add" class="btn btn-success">Ajouter</a>
</p>

<table class="table">
    <thead>
    <tr>
        <td>Id</td>
        <td>Titre</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $category): ?>
        <tr>
            <td><?= $category->id ?></td>
            <td><?= $category->titre ?></td>
            <td>
                <a href="?p=admin.categories.edit&id=<?=$category->id; ?>" class="btn btn-primary">Editer</a>
                <form action="?p=admin.categories.delete" method="post" style="display: inline-flex;">
                    <input type="hidden" name="id" value="<?= $category->id ?>">
                    <button type="submit" class="btn btn-danger" href="?p=admin.categories.delete&id=<?= $category->id; ?>">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
