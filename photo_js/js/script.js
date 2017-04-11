/**
 * Created by mathieumoullec on 06/04/2017.
 */

(function () {

    var masking = function () {
        var image = null;
        var sel = null;
        var btn = false;
        var son = document.createElement('img');
        for (var i = 0; i < masks.length; i++) {
            masks[i].addEventListener('click', function (e) {
                if (!sel) {
                    sel = this;
                    sel.style.opacity = 0.5;
                }
                else {
                    sel.style.opacity = 1;
                    if (sel === this) {
                        e.preventDefault();
                        alert('vous ne pouvez pas selectionner le meme masque');
                    }
                    sel = this;
                    sel.style.opacity = 0.5;
                }
                e.stopPropagation();
                if (btn == false) {
                    createbtn();
                    btn = true;
                }
                son.src = sel.src;
                son.width = sel.width;
                son.height = sel.height;
                son.setAttribute('style',
                    "position: absolute; bottom:" +
                    (video.height / 2 - son.height / 2) +
                    "px; right: " +
                    (video.width / 2 - son.width / 2) +
                    "px; z-index:10;");
                son.setAttribute('draggable', 'true');
                if ((player.lastElementChild.tagName) === 'IMG') {
                    player.removeChild(player.lastElementChild);
                }
                console.log(player.appendChild(son));
                image = player.appendChild(son);
                image.style.cursor = 'move';
                size(son);
                draganddrop(son);
                capturing(son);
            })
        }
    };

    var draganddrop = function (son) {
        son.addEventListener('dragstart', function (e) {
            e.dataTransfer.setData('image/png', '');
            e.dataTransfer.setDragImage(this, this.width / 2, this.height / 2);
        })
        video.addEventListener('dragover', function (e) {
            e.preventDefault();
        })
        player.addEventListener('drop', function (e) {
            e.preventDefault();
            var x = player.clientWidth - 10 - e.layerX - (son.width / 2);
            var y = player.clientHeight - 10 - e.layerY - (son.height / 2);
            son.setAttribute('style',
                'position: absolute; ' +
                'z-index: 10; ' +
                'cursor: move; ' +
                'right: ' + x + 'px; ' +
                'bottom : ' + y + 'px;');
        })
    };

    var capturing = function (son) {
        var photo = document.createElement('img');
        var x, y, bottom, right;
        photo.className = 'booth';
        bottom = parseInt(son.style.bottom);
        right = parseInt(son.style.right);
        x = video.width + 10 - son.width - right;
        y = video.height + 10 - son.height - bottom;
        document.getElementById('capture').addEventListener('click', function (e) {
            context.drawImage(video, 0, 0, 400, 300);
            context.drawImage(son, x, y, son.width, son.height);
            photo.setAttribute('src', canvas.toDataURL('image/png'));
            player.appendChild(photo);
        })
    }



    var size = function (son) {
        more.addEventListener('click', function (e) {
          e.preventDefault()
          son.width++;
          son.height++;
        })
        less.addEventListener('click', function (e) {
            e.preventDefault();
            son.height--;
            son.width--;
        })
    };

    var streamvideo = function () {
        navigator.getMedia = navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia ||
            navigator.msGetUserMedia;

        navigator.getMedia({
                video: true,
                audio: false
            }, function (stream) {
                video.src = vendor.createObjectURL(stream);
                video.play();
            }
            , function (e) {
                alert("impossible d\'acceder a la cam");
            });

    };

    var createbtn = function () {
        var buttons = document.createElement('div');
        var ml = document.createElement('div');
        var capture = document.createElement('a');
        var delbtn = document.createElement('a');
        var more = document.createElement('img');
        var less = document.createElement('img');

        ml.style.display = 'flex';

        buttons.className = 'buttons';
        buttons.id = 'buttons';

        capture.href = '#';
        capture.id = 'capture';
        capture.text = 'Take photo';
        capture.className = 'booth-capture-button';

        delbtn.href = '#';
        delbtn.id = 'del_mask'
        delbtn.className = 'booth-capture-button';
        delbtn.text = 'Delete selected mask';

        more.src = 'images/more.png';
        more.id = 'more';
        more.className = 'ml';

        less.src = 'images/less.png';
        less.id = 'less';
        less.className = 'ml';

        buttons.appendChild(ml);
        buttons.appendChild(capture);
        buttons.appendChild(delbtn);
        ml.appendChild(more);
        ml.appendChild(less);

        mozaic.appendChild(buttons);
    };

    var mozaic = document.getElementById('mozaic');
    var player = document.getElementById('player');
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var allmasks = document.getElementById('masques-gallery');
    var masks = allmasks.querySelectorAll('.masque');
    var vendor = window.URL || window.webkitURL;

    streamvideo();
    masking();
}());