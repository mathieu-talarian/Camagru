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
        player = document.querySelector('.player');
        video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        booth = document.getElementById('booth'),
        vendorUrl = window.URL || window.webkitURL,
        photo = document.createElement('img'),
        capture = document.getElementById('capture'),
        share = document.createElement('a'),
        del_btn = document.getElementById('del-btn'),
        file = document.getElementById('file'),
        img = document.createElement('img'),
        gallery = document.getElementById('gallery');
    var masques_gallery = document.getElementById('masques-gallery');
    var masques = masques_gallery.querySelectorAll('.masque');
    var selected = null;


    document.getElementById('heart').removeChild(del_btn);

    /**
     * share button
     */
    share.href = "#";
    share.id = "share";
    share.className = "booth-capture-button";
    share.text = 'Share photo';

    /**
     * navigateur
     */
    var play = function () {
        navigator.getMedia = navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia ||
            navigator.msGetUserMedia;
        navigator.getMedia({
                video: true,
                audio: false
            }, function (stream) {
                video.src = vendorUrl.createObjectURL(stream);
                video.play();
            },
            function (e) {
                alert('impossible d\'acceder a la webcam');
                e.preventDefault();
            }
        );
    }

    var image_dl = function() {
            function createThumbnail(file) {
                var reader = new FileReader();
                reader.addEventListener('load', function() {
                    var imgElement = document.createElement('img');
                    imgElement.style.maxWidth = '150px';
                    imgElement.style.maxHeight = '150px';
                    imgElement.src = this.result;
                    booth.removeChild(video);
                    booth.removeChild(capture);
                    img.src = imgElement.src;
                    img.height = 300;
                    img.width = 400;
                    booth.appendChild(img);
                    booth.appendChild(capture);
                    create_button_video();
                });
                reader.readAsDataURL(file);
            }
            var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'];
            file.addEventListener('change', function() {
                var files = this.files,
                    filesLen = files.length,
                    imgType;
                for (var i = 0; i < filesLen; i++) {
                    imgType = files[i].name.split('.');
                    imgType = imgType[imgType.length - 1];
                    if (allowedTypes.indexOf(imgType) != -1) {
                        createThumbnail(files[i]);
                    }
                }
            });
    };

    // var create_del_btn = function () {
    //     if (booth.lastChild.id !== 'delbtn') {
    //         var delbtn = document.createElement('div');
    //         delbtn.id = 'delbtn';
    //         delbtn.classList = 'btn';
    //         var a = document.createElement('a');
    //         a.href = '#';
    //         a.id = 'del_mask';
    //         a.innerHTML = 'Delete Selected Mask';
    //         a.classList = 'booth-capture-button';
    //         delbtn.appendChild(a);
    //         booth.appendChild(delbtn);
    //         delbtn.addEventListener('click', function (e) {
    //             e.preventDefault();
    //             selected.removeAttribute('style');
    //             selected = null;
    //             player.removeChild(player.lastElementChild);
    //             booth.removeChild(delbtn);
    //         });
    //     };
    // };


    var create_button_video = function () {
        div = document.createElement('div');
        btn = document.createElement('button');
        div.appendChild(btn);
        player.appendChild(div);
        btn.innerHTML = 'Video';
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            booth.removeChild(img);
            booth.removeChild(capture);
            booth.appendChild(video);
            booth.appendChild(capture);
            player.removeChild(div);
            play();
        })
    };

    mask();
    play();
    image_dl();
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
