(function() {
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var photo = document.getElementById('photo');
    var vendor = window.URL || window.webkitURL;
    var player = document.getElementById('player');
    var more_less = document.getElementById('more_less');
    var masques_gallery = document.getElementById('masques-gallery');
    var masques = masques_gallery.querySelectorAll('.masque');
    var selected = null;
    var more = document.getElementById('more');
    var less = document.getElementById('less');

    console.log (video);
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
            e.preventDefault();
            alert ("impossible d\'acceder a la cam");
        });

    // document.getElementById('capture').addEventListener('click', function () {
    //     console.log(video);
    //     context.drawImage(video, 0, 0, 400, 300);
    //     photo.setAttribute('src', canvas.toDataURL('image/png'));
    // });

    
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
                more_less.removeAttribute('style', 'display');
                var image = document.createElement('img');
                image.src = selected.src;
                image.setAttribute('style', 'position: absolute; z-index: 10; top: 1px; left: 1px;')
                // image.setAttribute('style', 
                // "position: absolute; top:" + 
                // (video.height / 2 - image.height / 2) + 
                // "px; right: " + 
                // (video.width / 2 - image.width / 2) +
                // "px; z-index:10;");
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
                test.addEventListener('dragstart', function(e) {
                    e.dataTransfer.setData('image/png', '');
                    // console.log(e);
                    e.dataTransfer.setDragImage(this, this.width / 2, this.height / 2);
                })
                video.addEventListener('dragover', function (e) {
                    e.preventDefault();
                })
                video.addEventListener('click', function (e) {
                         console.log('layerx = ', e.layerX);
                    console.log('layery = ', e.layerY);
                })
                video.addEventListener('drop', function (e) {
                    e.preventDefault();
                    // console.log(e);
                    // var target = e.target;
                    console.log('layerx = ', e.layerX);
                    console.log('layery = ', e.layerY);
                    console.log(test.height);
                    console.log(test.width);
                    var x = e.layerX + (test.width / 2);
                    if (x < 0) {
                        x = 0;
                    }
                    if (y < 0) {
                        y = 0;
                    }
                    var y = video.height - e.layerY -  (test.height / 2);
                    // console.log(x);
                    // console.log('target', target);
                    test.setAttribute('style', 'position: absolute; z-index: 10; cursor: move; right: ' + x + 'px; bottom:' + y + 'px;');
                    // console.log(test);
                })
            }
        );
    }
} ());

