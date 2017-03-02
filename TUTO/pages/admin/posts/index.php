<?php

$posts = App::getInstance()->getTable('post')->all();
?>


<h1>Administrer les articles</h1>

<p>
    <a href="?p=post.add" class="btn btn-success">Ajouter</a>
</p>

<table class="table">
    <thead>
    <tr>
        <td>Id</td>
        <td>Titre</td>
        <td>Contenu</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
     <?php foreach ($posts as $post): ?>
         <tr>
             <td><?= $post->id ?></td>
             <td><?= $post->titre ?></td>
             <td><?= $post->contenu ?></td>
             <td>
                 <a href="?p=post.edit&id=<?=$post->id; ?>" class="btn btn-primary">Editer</a>
             </td>
         </tr>
    <?php endforeach; ?>
    </tbody>
</table>