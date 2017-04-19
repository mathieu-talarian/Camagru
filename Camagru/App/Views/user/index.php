<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 3/13/17
 * Time: 3:07 PM
 */

?>

<form id ="del-btn" action="?p=image.delete" method="post" style="display: inline-flex;">
    <input type="hidden" name="id" value="">
    <button type="submit" class="" style="red" href="">Supprimer</button>
</form>

    <div class="player">
        <div id="booth" class="booth">
            <video id="video" width="400" height="300"></video>
            <a href="#" id="capture" class="booth-capture-button">
                Take photo
            </a>
            <canvas id="canvas" width="400" height="300"></canvas>
        </div>
    </div>
        <div id="gallery" class="gallery">
            gallerie de photos perso
    </div>
<script src="Public/js/photo_script.js"></script>