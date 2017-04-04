<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>photo.js</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<div class="page">
    <div class="header">
        <a href="#">login</a>
        <a href="#">tuto</a>
        <a href="#">tuto</a>
        <a href="#">tuto</a>
        <a href="#">tuto</a>
        <a href="#">tuto</a>
    </div>

    <div class="sidebar">
        <form action="#">
            <label for="">Pseudo</label>
            <input type="text">
            <label for="">Mot de passe</label>
            <input type="password">
        </form>
    </div>
<div class="body">
    <div class="mosaic" id="mozaic">
        <div id="player" class="player">
        <video class="booth" id="video" width="400" height="300"></video>
        </div>
        <div class="buttons">
        <div class="btn">
        <a href="#" id="capture" style="display: none;" class="booth-capture-button">Take photo</a>
        </div>
        <div class="btn">
            <a href="#" id="del_mask" style="display: none;" class="booth-capture-button">Delete selected masque</a>
        </div>
        <div class="more">
        <img class="ml" src="images/more.png">
        </div>
        <div class="less">
        <img class="ml" src="images/less.png">
        </div>
        </div>
        <canvas id="canvas" width="400" height="300"></canvas>
        <img id="photo" src="" alt="">
    </div>
</div>
    <div id="masques-gallery" class="masques-gallery">
        <div class="image-height">
            <img id="masque" class="masque" src="images/m1.jpeg" alt="">
        </div>
        <div class="image-height">
            <img id="masque" class="masque" src="images/m2.png" alt="">
        </div>
        <div class="image-height">
            <img id="masque" class="masque" src="images/m3.png" alt="">
        </div>
    </div>

<div class="footer">
    <em>mmoullec @ 42 2017</em>
</div>
    <script src="js/photo.js"></script>
</div>
</html>