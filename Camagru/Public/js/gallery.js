/**
 * Created by mathieumoullec on 14/04/2017.
 */

(function () {
    var gallery = document.getElementById('heart');
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
        xhr.open('GET', 'index.php?p=user.getphotos', true);
        xhr.send(null);


    };

    var callback = function (dt) {
        console.log(dt);
        datas = JSON.parse(dt);
        for(var i = 0; i < datas.length; i++) {
            var data = datas[i];
            var div = document.createElement('div');
            var img = document.createElement('img');
            var infos = document.createElement('div');
            img.src = data.contenu;
            infos.innerHTML = ('<p>' + data.pseudo + '</p>photographié le' + data.date);
            div.appendChild(infos);
            div.appendChild(img);
            gallery.appendChild(div);
        }
    };


    aff_photo(callback);
}) ();
