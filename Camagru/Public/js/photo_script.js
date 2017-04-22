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

    var config_btn;
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
        if (data) {
            var dt = JSON.parse(data);
            var photos = gallery.querySelectorAll('#photo_perso');
            for (var i = 0; i < photos.length; i++) {
                gallery.removeChild(photos[i]);
            }
            for (var i = 0; i < dt.length; i++) {
                var d = dt[i];
                var div = document.createElement('div');
                div.innerHTML = d.id;
                var del = del_btn.cloneNode(true);
                config_btn(del, d.id);
                div.id = 'photo_perso';
                var img = document.createElement('img');
                img.id = 'stamp';
                img.src = d.contenu;
                img.width = 400 / 2;
                img.height = 300 / 2;
                // div.appendChild(img);
                // gallery.appendChild(div);
                div.appendChild(img);
                div.appendChild(del);
                gallery.appendChild(div);
            }
        }
    };

    config_btn = function (del, id) {
        var h = "?p=image.delete&id=" + id;
        var input = del.children[0];
        var btn = del.children[1];
        input.attributes[1].value = id;
        btn.attributes[3].value = h;
        del.addEventListener('click', function (e) {
            e.preventDefault();
            var xhr = getXMLHTTPRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
                    alert(JSON.parse(xhr.responseText));
                    galleryperso(readData);
                }
                else {
                    //TODO upload image perso
                    // alert ('probleme de connection avec le serveur');
                }
            };
            xhr.open('POST', h);
            var form = new FormData;
            form.append('id', id);
            xhr.send(form);
        })
    };

    /**
     * variables
     */
    var
        video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        booth = document.getElementById('booth'),
        vendorUrl = window.URL || window.webkitURL,
        photo = document.createElement('img'),
        capture = document.getElementById('capture'),
        share = document.createElement('a'),
        del_btn = document.getElementById('del-btn'),
        gallery = document.getElementById('gallery');


    document.getElementById('heart').removeChild(del_btn);

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
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
                galleryperso(readData);
            }
            else {
                // alert ('probleme de connection avec le serveur');
            }
        };
        var data = new FormData;
        context.drawImage(video, 0, 0, 400, 300);
        photo.setAttribute('src', canvas.toDataURL('image/png'));
        data.append('img', photo.getAttribute('src'));
        xhr.open('POST', 'index.php?p=user.dlphoto');
        xhr.send(data);
    });
}) ();
