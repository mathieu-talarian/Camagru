(function () {
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var buttons = document.getElementById('buttons');
    var delbtn = document.getElementById('del_mask');
    var capture = document.getElementById('capture');
    // var photo = document.getElementById('photo');
    var vendor = window.URL || window.webkitURL;
    var player = document.getElementById('player');
    var more_less = document.getElementById('more_less');
    var masques_gallery = document.getElementById('masques-gallery');
    var masques = masques_gallery.querySelectorAll('.masque');
    var selected = null;
    var more = document.getElementById('more');
    var less = document.getElementById('less');

    console.log(video);
    navigator.getMedia = navigator.webkitGetUserMedia ||
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
    for (var i = 0; i < masques.length; i++) {
        masques[i].addEventListener('click', function (e) {
                if (!selected) {
                    selected = this;
                    selected.setAttribute('style', 'opacity: 0.5');
                }
                else {
                    selected.removeAttribute('style');
                    if (selected === this) {
                        alert('Vous ne pouvez pas selectionner le meme objet');
                    }
                    selected = this;
                    selected.setAttribute('style', 'opacity: 0.5');
                }
                e.stopPropagation();
                buttons.removeAttribute('style', 'display');
                more_less.removeAttribute('style', 'display');
                var image = document.createElement('img');
                image.src = selected.src;
                image.setAttribute('style',
                "position: absolute; bottom:" +
                (video.height / 2 - image.height / 2) +
                "px; right: " +
                (video.width / 2 - image.width / 2) +
                "px; z-index:10;");
                image.setAttribute('draggable', 'true');
                if ((player.lastElementChild.tagName) === 'IMG') {
                    player.removeChild(player.lastElementChild);
                }
                var test = player.appendChild(image);
                test.style.cursor = "move";
                more.addEventListener('click', function (e) {
                    test.width++;
                    test.height++;
                })
                less.addEventListener('click', function (e) {
                    test.width--;
                    test.height--;
                })
                test.addEventListener('dragstart', function (e) {
                    e.dataTransfer.setData('image/png', '');
                    e.dataTransfer.setDragImage(this, this.width / 2, this.height / 2);
                })
                video.addEventListener('dragover', function (e) {
                    e.preventDefault();
                })
                player.addEventListener('drop', function (e) {
                    e.preventDefault();
                    console.log(player);
                    console.log(e);
                    console.log(test.width / 2);
                    console.log(video.width);
                    var x = player.clientWidth - 10 - e.layerX - (test.width / 2);
                    var y = player.clientHeight - 10 - e.layerY - (test.height / 2);
                    console.log(test.x);
                    test.setAttribute('style', 'position: absolute; z-index: 10; cursor: move; right: ' + x + 'px; bottom : ' + y + 'px;');
                    console.log(test.getAttribute('style'));
                })
                delbtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    buttons.setAttribute('style', 'display: none;');
                    more_less.setAttribute('style', 'display: none;');
                    selected.removeAttribute('style');
                    selected = null;
                    player.removeChild(player.lastElementChild);
                })
                capture.addEventListener('click', function () {
                    var photo = document.createElement('img');
                    photo.className = 'booth';
                    bottom = parseInt(test.style.bottom);
                    right = parseInt(test.style.right);
                    var x = video.width + 10 - test.width - right;
                    var y = video.height + 10 - test.height - bottom;
                    console.log('x = ', x, '\ny =', y);
                    context.drawImage(video, 0, 0, 400, 300);
                    context.drawImage(test, x, y);
                    video.style.display = ('none');
                    test.style.display = 'none';
                    photo.setAttribute('src', canvas.toDataURL('image/png'));
                    player.removeChild(video);
                    player.appendChild(photo);

            });
            }
        );
    }
}());

