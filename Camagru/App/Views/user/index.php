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
        <div>
                <input class="booth-capture-button" value="Changer de photo" id="file" type="file" name="image" accept="image/png">
        </div>
        <div id="booth" class="booth">
            <div id="mozaic" class="mozaic">
            <video class="video" id="video" width="400" height="300"></video>
                </div>
            <canvas id="canvas" width="400" height="300"></canvas>
            <canvas id="canvas2" width="400" height="300"></canvas>
        </div>
        <div id="masques-gallery" class="masques-gallery">
            <div class="image-height">
                <img id="masque" class="masque" src="Public/images/m1.jpeg" alt="">
            </div>
            <div class="image-height">
                <img id="masque" class="masque" src="Public/images/m2.png" alt="">
            </div>
            <div class="image-height">
                <img id="masque" class="masque" src="Public/images/m3.png" alt="">
            </div>
            <div class="image-height">
                <img id="masque" class="masque" src="Public/images/white.png" alt="">
            </div>
        </div>
    </div>
        <div id="gallery" class="gallery">
            gallerie de photos perso
    </div>
<script src="Public/js/photo_script.js"></script>