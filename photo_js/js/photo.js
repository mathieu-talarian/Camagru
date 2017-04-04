(function() {
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var photo = document.getElementById('photo');
    var vendor = window.URL || window.webkitURL;
    var player = document.getElementById('player');
    var capt_btn = document.getElementById('capture');
    var del_btn = document.getElementById('del_mask');

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
        });

    document.getElementById('capture').addEventListener('click', function () {
        console.log(video);
        context.drawImage(video, 0, 0, 400, 300);
        photo.setAttribute('src', canvas.toDataURL('image/png'));
    });

    var masques_gallery = document.getElementById('masques-gallery');
    var masques = masques_gallery.querySelectorAll('.masque');
    var selected = null;

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
                capt_btn.removeAttribute('style', 'display');
                del_btn.removeAttribute('style', 'display');
                var image = document.createElement('img');
                image.src = selected.src;
                image.setAttribute('style', 'position: absolute; top: 30px; right: 10px; z-index:10;');
                image.setAttribute('draggable', 'true');
                if ((player.lastElementChild.tagName) === 'IMG') {
                    player.removeChild(player.lastElementChild);
                }
                var test = player.appendChild(image);
                var tall = document.createElement('img');
                tall.src = 'images/more.png';
                tall.setAttribute('style', 'width: 50 px; height: 50px;')
                var mozaic = document.getElementById('mozaic');
                mozaic.appendChild(tall);
                test.addEventListener('click', function (e) {
                    var sel = this;
                    console.log(sel.width);
                })
            }
        );
    }
} ());

