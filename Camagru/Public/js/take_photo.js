/**
 * Created by mmoullec on 3/13/17.
 */


(function () {
    var video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        photo = document.getElementById('photo'),
        context = canvas.getContext('2d'),
        vendorUrl = window.URL || window.webkitURL;

    navigator.getMedia =    navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia ||
                            navigator.msGetUserMedia;

    // var vibrate = navigator.vibrate;

    // var geo = navigatorGeolocation.geolocation;

    navigator.getMedia({
        video: true,
        audio: false
    }, function(stream) {
        video.src = vendorUrl.createObjectURL(stream);
        video.play();
        },
        function(error) {
        //Error occured
        }
    )

    document.getElementById('capture').addEventListener('click', function (){
        context.drawImage(video, 0, 0, 400, 300);
        photo.setAttribute('src', canvas.toDataURL('image/png'));
    })

}) ();
