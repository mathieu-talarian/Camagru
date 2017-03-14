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
    <div class="mosaic">
        <video class="booth" id="video" width="400" height="300"></video>
        <a href="#" id="capture" class="booth-capture-button">Take photo</a>
        <canvas id="canvas" width="400" height="300"></canvas>
        <img id="photo" src="" alt="">
    </div>
</div>
    <div id="masques-gallery" class="masques-gallery">
        <div class="image-height">
            <img class="masque" id="m1" src="images/m1.jpeg" alt="">
        </div>
        <div class="image-height">
            <img class="masque" id="m1" src="images/m2.png" alt="">
        </div>
        <div class="image-height">
            <img class="masque" id="m1" src="images/m3.png" alt="">
        </div>
    </div>
<div class="footer">
    <em>mmoullec @ 42 2017</em>
</div>
    <script src="js/photo.js"></script>
</div>
</html>