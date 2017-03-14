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
        context.drawImage(video, 0, 0, 400, 300);
        photo.setAttribute('src', canvas.toDataURL('image/png'));
    });

}) ();

var masques = document.getElementById('masques-gallery');
var masque = masques.children;

for (var i = 0; i < masque.length; i++) {
    var sel = masque[i];
    sel.addEventListener('click', function() {
        photo.setAttribute('src', canvas.toDataURL('image/png'));
    })

};
