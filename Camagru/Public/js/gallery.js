/**
 * Created by mathieumoullec on 14/04/2017.
 */

(function () {
    var gallery = document.getElementById('heart');
    var form = document.getElementById('comm');
    gallery.removeChild(form);
    function extract_url() {
        var t = location.search.substring(1).split('&');
        var f = [];
        for (var i=0; i < t.length; i++) {
            var x = t[i].split('=');
            f[x[0]]=x[1];
        }
        return f;
    }
    var f = extract_url();

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
        if (f['g']) {
            xhr.open('GET', 'index.php?p=user.getphotos&g=' + f['g'], true);
        } else {
            xhr.open('GET', 'index.php?p=user.getphotos')
        }
        xhr.send(null);
    };

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


    var create_pages = function(nbr) {
        nbr = nbr / 10;
        for (var i = 0; i < nbr; i++) {
            var a = document.createElement('a');
            var pg = i + 1;
            a.innerHTML = 'page' + pg;
            a.href = 'index.php?p=user.gallery&g=' + pg;
            gallery.appendChild(a);
        }
    }

    var callback = function (dt) {
        datas = JSON.parse(dt);
        for(var i = 0; i < datas.length; i++) {
            var f = form.cloneNode(true);
            var data = datas[i];
            var div = document.createElement('div');
            var img = document.createElement('img');
            var infos = document.createElement('div');
            div.id = 'images no' + data.id;
            f.id = data.id;
            img.src = data.contenu;
            img.id = data.id;
            infos.innerHTML = ('<p>' + data.pseudo + '</p>photographié le ' + data.date);
            var champ = f.querySelector('.form-control');
            champ.id = data.id;
            champ.setAttribute('value', data.id);
            div.appendChild(infos);
            div.appendChild(img);
            div.appendChild(f);
            gallery.appendChild(div);
            fillcomments(div, data.id, comments);
        }
    };

    var fillcomments = function(div, id, callback) {

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
        for(var i = 0; i < datas.length; i++) {
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
    aff_photo(callback);

    var images = document.querySelectorAll('#image');
    console.log(images);

}) ();