/**
 * Created by mmoullec on 3/13/17.
 */


(function() {

    /** ajax
     * 
     */
    function getXMLHttpRequest() {
        var xhr = null;

        if (window.XMLHttpRequest || window.ActiveXObject) {
            if (window.ActiveXObject) {
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            } else {
                xhr = new XMLHttpRequest();
            }
        } else {
            alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
            return null;
        }

        return xhr;
    }
    /** */

    var request = function(callback, method, page, node) {
        var xhr = getXMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                alert('ok');
                callback(node, xhr.responseText);

            } else {
                alert('ko ' + xhr.readyState + '\n ' + xhr.status + '\n ' + xhr.status + '\n');
            }
        };
        xhr.open(method, page, true);
        xhr.send(null);
    };

    var readData = function(node, oData) {
        console.log(oData);
        node.innerHTML = oData;
    };

    var gallery = function() {
        var gallery = document.getElementById('gallery');
        request(readData, "GET", "index.php?p=user.galleryperso", gallery);
    };



    /** definition des variables
     * 
     */
    var
        video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        booth = document.getElementById('booth');
    vendorUrl = window.URL || window.webkitURL,
        photo = document.createElement('img'),
        share = document.createElement('a');
    /** */


    /** definiton du bouton share
     * 
     */
    share.href = "#";
    share.id = "share";
    share.classList = "booth-capture-button";
    share.text = 'Share photo';
    /** */

    /**option naviageur */
    navigator.getMedia = navigator.getUserMedia ||
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
        function(e) {
            alert('impossible d\'acceder a la webcam');
            e.preventDefault();
        }
    )

    gallery();
    // document.getElementById('capture').addEventListener('click', function() {
    //     context.drawImage(video, 0, 0, 400, 300);
    //     booth.removeChild(video);
    //     booth.appendChild(photo);
    //     booth.removeChild(this);
    //     booth.appendChild(share);
    //     photo.setAttribute('src', canvas.toDataURL('image/png'));
    // })

    // share.addEventListener('click', function(e) {
    //     e.preventDefault();
    //     req = getXMLHttpRequest();
    //     console.log('test');
    //     req.open('GET', 'index.php?p=user.sharephoto&src=' + photo.src);
    //     req.send(null);

    //     req.onreadystatechange = function() {
    //         if (req.readyState == 4 && (req.status == 200 || req.status == 0)) {
    //             alert('ok');
    //         } else {
    //             alert('ko ' + req.readyState + '\n ' + req.status + '\n ' + req.status + '\n');
    //         }

    //     };
    //     gallery();
    // })

})();