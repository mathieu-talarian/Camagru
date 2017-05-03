/**
 * Created by mathieumoullec on 14/04/2017.
 */

(function () {
    var gallery = document.getElementById('heart');
    var form = document.getElementById('comm');
    var lk = document.getElementById('like');
    var dl = document.getElementById('dislike');
    gallery.removeChild(form);
    gallery.removeChild(lk);
    gallery.removeChild(dl);


    /** recuperer l'url et parse get */
    var get = function extract_url() {
        var t = location.search.substring(1).split('&');
        var f = [];
        for (var i = 0; i < t.length; i++) {
            var x = t[i].split('=');
            f[x[0]] = x[1];
        }
        return f;
    }

    /** AJAX affiche photos */
    var aff_photo = function (callback) {
        var xhr = getXMLHTTPRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
                callback(xhr.responseText);
            }
            else {
                // alert ('probleme de connection avec le serveur');
            }
        };
        if (get['g']) {
            xhr.open('GET', 'index.php?p=user.getphotos&g=' + get['g'], true);
        } else {
            xhr.open('GET', 'index.php?p=user.getphotos')
        }
        xhr.send(null);
    };

    /** AJAX recupere toutes les photos pour pages */
    var all_photos = function (callback) {
        var xhr = getXMLHTTPRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
                callback(Math.floor(JSON.parse(xhr.responseText).length));
            }
            else {
                // alert ('probleme de connection avec le serveur');
            }
        };
        xhr.open('GET', 'index.php?p=user.allphotos');
        xhr.send(null);
    }

    /** AJAX fonction objet ajax */
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

    /** creation du nombre de pages en fonction du nbre de photos */
    var create_pages = function (nbr) {
        nbr = nbr / 10;
        for (var i = 0; i < nbr; i++) {
            var a = document.createElement('a');
            var pg = i + 1;
            a.innerHTML = 'page' + pg;
            a.href = 'index.php?p=user.gallery&g=' + pg;
            gallery.appendChild(a);
        }
    }


    var photos_comms_likes = function (dt) {
        var core = document.createElement('div');
        core.id = 'core';
        core.className = 'core';
        core.setAttribute('overflow', 'scollable');
        gallery.appendChild(core);
        var datas = JSON.parse(dt);
        for (var i = 0; i < datas.length; i++) {
            var data = datas[i];
            var f = form.cloneNode(true);
            var div = document.createElement('div');
            var img = document.createElement('img');
            var likes = document.createElement('div').id = 'likes';
            var infos = document.createElement('div');
            div.id = 'images no' + data.id;
            f.id = data.id;
            img.src = data.contenu;
            img.id = data.id;
            infos.innerHTML = ('<p>' + data.pseudo + '</p>photographié le ' + data.date);
            var champ = f.querySelector('.form-control');
            champ.id = data.id;
            all_likes_by_photo(write_likes_by_photo, data.id, div);
            user_like_photo(put_like_btn, data.id, div)
            champ.setAttribute('value', data.id);
            div.appendChild(infos);
            div.appendChild(img);
            div.appendChild(f);
            core.appendChild(div);
            fillcomments(div, data.id, comments);
        }
    };

    var put_like_btn = (datas, div, id) => {
        datas = JSON.parse(datas)
        console.log(datas)
        if (datas.length === 0) {
            let l = lk.cloneNode(true)
            div.appendChild(l);
            l.addEventListener('click', (e) => {
                e.preventDefault()
                let form = new FormData();
                form.append('photo_id', id)
                xhr_ready2('POST', 'index.php?p=image.like', form)
                window.location.reload()
            })
        }
        else {
            let d = dl.cloneNode(true)
            div.appendChild(d)
            d.addEventListener('click', (e) => {
                e.preventDefault()
                let form = new FormData()
                form.append('photo_id', id)
                xhr_ready2('POST', 'index.php?p=image.dislike', form)
                window.location.reload()
            })
        }
    }

    var user_like_photo = (callback, photo_id, div)=> {
        let form = new FormData()
        form.append('photo_id', photo_id)
        xhr_ready('POST', 'index.php?p=image.user_like_photo', put_like_btn, form, div, photo_id)
    }

    var xhr_ready = (method, url, callback = null, form = null, div = null, id= null) => {
        let xhr = getXMLHTTPRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
                callback(xhr.responseText, div, id)
            }
            else {
                // alert ('probleme de connection avec le serveur');
            }
        };
        xhr.open(method, url);
        xhr.send(form);
    }

    let xhr_ready2 = (method, url, form) => {
        let xhr = getXMLHTTPRequest()
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
                xhr.responseText
            }
            else {
                // alert ('probleme de connection avec le serveur');
            }
        };
        xhr.open(method, url)
        xhr.send(form)
    }

    var write_likes_by_photo = (datas, div)=> {
        datas = JSON.parse(datas);
        var r = document.createElement('div');
        if (datas.length !== 0) {
            r.id = 'likes';
            var nb = document.createElement('h')
            nb.innerHTML = datas.length + ' like(s)'
            r.appendChild(nb);
            for (var i = 0; i < datas.length; i++) {
                var data = datas[i];
                var t = document.createElement('p')
                t.innerHTML = data.pseudo + ' aime votre photo'
                r.appendChild(t)
            }
        }
        else {
            r.id = 'nolike';
            r.innerHTML = 'Pas encore de likes';

        }
        div.appendChild(r)
    }

    var all_likes_by_photo = (callback, photo_id, div)=> {
        let xhr = getXMLHTTPRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
                callback(xhr.responseText, div)
            }
            else {
                // alert ('probleme de connection avec le serveur');
            }
        };
        xhr.open('POST', 'index.php?p=image.nb_photo_like');
        let form = new FormData();
        form.append('photo_id', photo_id);
        xhr.send(form);


    }

    var fillcomments = function (div, id, callback) {
        var xhr = getXMLHTTPRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && (xhr.status == 200 || xhr.status == 0)) {
                callback(xhr.responseText, div);
            }
            else {
                // alert ('probleme de connection avec le serveur');
            }
        };
        xhr.open('POST', 'index.php?p=commentaire.getcomm');
        var form = new FormData();
        form.append('id', id);
        xhr.send(form);
    }

    var comments = function (rep, div) {
        var comm = document.createElement('div');
        comm.id = 'Commentaire';
        datas = JSON.parse(rep);
        comm.setAttribute('style', 'background: blue; padding: 10px')
        for (var i = 0; i < datas.length; i++) {
            var data = datas[i];
            var da = document.createElement('div')
            da.setAttribute('style', 'color:white; background: black; margin: 10px 0;')
            da.id = 'commentaire';
            da.innerHTML = data.pseudo + ' a commente le ' + data.date + '<br>' + data.contenu;
            comm.appendChild(da);
        }
        div.appendChild(comm);
    }

    all_photos(create_pages);
    aff_photo(photos_comms_likes);

    var images = document.querySelectorAll('#image');

})();
