<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 3/13/17
 * Time: 3:07 PM
 */

?>

<div class="booth">
    <video id="video" width="400" height="300"></video>
    <a href="#" id="capture" class="booth-capture-button">
        Take photo
    </a>
    <canvas id="canvas" width="400" height="300"></canvas>
    <img id="photo">
       <form id="form" action="#" method="post">
           form action="" method="post">
           <?= $form->input('titre', 'Titre'); ?>
           <?= $form->input_required('passwd-verif', 'Repetez le mot de passe', ['type' => 'password']); ?>

           <button class="btn btn-primary">Submit</button>
       </form>

    </form>
</div>
<script src="Public/js/take_photo.js"></script>