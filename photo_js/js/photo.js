(function() {
    // window.alert("bonjour");
    var video = document.getElementById('video');
    var vendor = window.URL || window.webkitURL;

    navigator.getMedia =    navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mosGetUserMedia ||
                            navigator.msGetUserMedia;


    navigator.getMedia({
        video: true,
        audio: false
    } , function(stream) {
        video.src = vendor.createObjectURL(stream);
        video.play();
        },
        function(e) {
        alert ('an error occured');
        }
    )
});