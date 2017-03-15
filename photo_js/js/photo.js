(function() {
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var photo = document.getElementById('photo');
    var vendor = window.URL || window.webkitURL;

    navigator.getMedia =    navigator.webkitGetUserMedia ||
                                navigator.mozGetUserMedia ||
                                navigator.msGetUserMedia;


    navigator.getMedia({
        video: true,
        audio: false
        }, function(stream) {
        video.src = vendor.createObjectURL(stream);
        video.play();
        }
        , function(e) {
        });

    document.getElementById('capture').addEventListener('click', function() {
        console.log(video);
        context.drawImage(video, 0, 0, 400, 300);
        photo.setAttribute('src', canvas.toDataURL('image/png'));
    });

}) ();


var canvas = document.getElementById('canvas');
console.log(canvas);
context = canvas.getContext('2d', {preserveDrawingBuffer: true});
console.log(context);
var masques_gallery = document.getElementById('masques-gallery');
var masques = masques_gallery.querySelectorAll('.masque');
var photo = document.getElementById('photo');

for(var i = 0; i < masques.length; i++) {
    masques[i].addEventListener('click', function (){
        var alpha = 50;
        this.style.opacity = alpha / 100;
        // if (this.body.filters != undefined)
        // {
        //     this.style.filter = 'alpha(opacity:' + alpha + ')';
        // }
        console.log(this);
        var image = document.createElement('img');
        image.src = this.src;
        console.log(this.width);
        console.log(this.height);
        var x = 400/4;
        var y = 300/4;
        context.drawImage(this, x, y, x + this.width, y + this.height);
        photo.setAttribute('src', canvas.toDataURL('image/png'));
    });
}


