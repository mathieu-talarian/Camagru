<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 3/6/17
 * Time: 8:19 PM
 */

?>

<h1>
    Bienvenue <?= $pseudo ?>
</h1>

<video id="video"></video>
<button id="startbutton">Take photo</button>
<canvas id="canvas"></canvas>
    <photo id="photo"></photo>
    <script type="text/javascript" src="Public/js/photo.js"></script>

<?= $photo; ?>