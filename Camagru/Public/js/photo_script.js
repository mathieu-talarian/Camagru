/**
 * Created by mmoullec on 4/13/17.
 */

(function () {
    /**
     * ajax object
     */
    function getXMLHTTPRequest() {
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

    var galleryperso = function (callback) {
      var gallery = document.getElementById('gallery');
      var xhr = getXMLHTTPRequest();
      xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
              callback(xhr.responseText);
          }
          else {
              // alert ('probleme de connection avec le serveur');
          }
      };
      xhr.open('GET', 'index.php?p=user.galleryperso', true);
      xhr.send(null);
    };

    var readData = function (data) {
        console.log(data);
        var dt = JSON.parse(data);
        console.log(dt);
        var photos = gallery.querySelectorAll('#stamp');
        for (var i = 0; i < photos.length; i++) {
            gallery.removeChild(photos[i]);
        }
        for (var i = 0; i < dt.length; i++) {
            var img =document.createElement('img');
            img.id = 'stamp';
            img.src = dt[i].contenu;
            img.width = 400 / 2;
            img.height = 300 / 2;
            gallery.appendChild(img);
        }
    };

    /**
     * variables
     */
    var
        video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        booth = document.getElementById('booth');
        vendorUrl = window.URL || window.webkitURL,
        photo = document.createElement('img'),
        capture = document.getElementById('capture'),
        share = document.createElement('a'),
        gallery= document.getElementById('gallery');


    /**
     * share button
     */
    share.href = "#";
    share.id = "share";
    share.classList = "booth-capture-button";
    share.text = 'Share photo';

    /**
     * navigateur
     */
    navigator.getMedia = navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia;
    navigator.getMedia({
            video: true,
            audio: false
        }, function(stream) {
            video.src = vendorUrl.createObjectURL(stream);
            video.play();
        },
        function(e) {
             /** implementation de up file */
            alert('impossible d\'acceder a la webcam');
            e.preventDefault();
        }
    );

    galleryperso(readData);
    capture.addEventListener('click', function (e) {
        e.preventDefault();
        var xhr = getXMLHTTPRequest();
        var data = new FormData;
        context.drawImage(video, 0, 0, 400, 300);
        photo.setAttribute('src', canvas.toDataURL('image/png'));
        data.append('img', photo.getAttribute('src'));
        xhr.open('POST', 'index.php?p=user.dlphoto');
        xhr.send(data);
        galleryperso(readData);
    });
}) ();
