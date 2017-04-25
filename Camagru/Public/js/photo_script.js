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
    };

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

    var config_btn = function (del, id) {
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
    };

    var image_dl = function() {
        function createThumbnail(file) {
            var reader = new FileReader();
            reader.addEventListener('load', function() {
                var imgElement = document.createElement('img');
                imgElement.style.maxWidth = '150px';
                imgElement.style.maxHeight = '150px';
                imgElement.src = this.result;
                mozaic.removeChild(video);
                img.id = "video";
                img.classList = "video";
                img.src = imgElement.src;
                img.height = 300;
                img.width = 400;
                mozaic.appendChild(img);
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

    var create_button_video = function () {
        var div = document.createElement('div');
        var btn = document.createElement('button');
        div.appendChild(btn);
        player.appendChild(div);
        btn.innerHTML = 'Video';
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            mozaic.removeChild(img);
            mozaic.appendChild(video);
            player.removeChild(div);
            play();
        })
    };

    var mask_photo = function () {
      for (var i = 0; i < masques.length; i++) {
          var masque = masques[i];
          masque.addEventListener('click', function (e) {
              if (!selected) {
                  selected = this;
                  selected.setAttribute('style', 'opacity: 0.5');
              }
              else {
                  selected.removeAttribute('style');
                  if (selected === this) {
                      e.preventDefault();
                      alert('ne pas utiliser le meme masque');
                  }
                  selected = this;
                  selected.setAttribute('style', 'opacity: 0.5');
              }
              e.stopPropagation();
              var img = document.createElement('img');
              img.src = selected.src;
              img.id = 'mas';
              img.setAttribute('style',
                  "position: absolute; bottom:" +
                  (video.height / 2 - img.height / 2) +
                  "px; right: " +
                  (video.width / 2 - img.width / 2) +
                  "px; z-index:10;");
              if (mozaic.lastElementChild.id !== 'video') {
                  mozaic.removeChild(mozaic.lastElementChild);
                  booth.removeChild(capture);
              }
              img.setAttribute('draggable', 'true');
              var test = mozaic.appendChild(img);
              booth.appendChild(capture);
              test.style.cursor = "move";
              test.addEventListener('dragstart', function (e) {
                  e.dataTransfer.setData('image/png', '');
                  e.dataTransfer.setDragImage(this, this.width / 2, this.height / 2);
              })
              video.addEventListener('dragover', function (e) {
                  e.preventDefault();
              })
              player.addEventListener('drop', function (e) {
                  e.preventDefault();
                  var x = mozaic.clientWidth - 10 - e.layerX - (test.width / 2);
                  var y = mozaic.clientHeight - 10 - e.layerY - (test.height / 2);
                  test.setAttribute('style', 'position: absolute; z-index: 10; cursor: move; right: ' + x + 'px; bottom : ' + y + 'px;');
              })
          })
      }
    };

    /**
     * variables
     */
    var
        player = document.querySelector('.player'),
        video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        booth = document.getElementById('booth'),
        vendorUrl = window.URL || window.webkitURL,
        photo = document.createElement('img'),
        capture = document.createElement('a'),
        del_btn = document.getElementById('del-btn'),
        file = document.getElementById('file'),
        img = document.createElement('img'),
        gallery = document.getElementById('gallery'),
        masques_gallery = document.getElementById('masques-gallery'),
        mozaic = document.getElementById('mozaic'),
        masques = masques_gallery.querySelectorAll('.masque'),
        selected = null;
    /** */

    /** enlever le boutton supprimer */
     document.getElementById('heart').removeChild(del_btn);
     /** */


    /**
     * capture
     */
    capture.href = "#";
    capture.id = "share";
    capture.className = "booth-capture-button";
    capture.text = 'Take and Share photo';




    mask_photo();
    play();
    image_dl();
    galleryperso(readData);
    capture.addEventListener('click', function (e) {
        e.preventDefault();
        var xhr = getXMLHTTPRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
                var ret = JSON.parse(xhr.responseText);
                if (ret === 'Des donnees manquent')
                {
                    alert (ret);
                    return;
                }
                else {
                    galleryperso(readData);
                }
            }
            else {
                //alert ('probleme de connection avec le serveur');
            }
        };
        var data = new FormData;
        var vid = document.getElementById('video');
        var mas = document.getElementById('mas');
        context.drawImage(vid, 0, 0, 400, 300);
        photo.setAttribute('src', canvas.toDataURL('image/png'));
        data.append('img', photo.getAttribute('src'));
        data.append('mask', mas.getAttribute('src'));
        data.append('right', mas.style.right);
        data.append('bottom', mas.style.bottom);
        data.append('x', mas.height);
        data.append('y', mas.width);
        xhr.open('POST', 'index.php?p=user.dlphoto');
        xhr.send(data);
    });
}) ();
