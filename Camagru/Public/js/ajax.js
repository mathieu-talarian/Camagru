(function() {


    function getXMLHttpRequest() {
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

    var req = getXMLHttpRequest();
    var gallery = document.getElementById('gallery');


    req.onreadystatechange = function(event) {
        // XMLHttpRequest.DONE === 4
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                console.log("Réponse reçu: %s", this.responseText);
            } else {
                console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
            }
        }
    };
    console.log(gallery);

    var share = document.getElementById('share');
    req.open('GET', 'index.php?p=user.gallery', true);
    req.send(null);

    req.onreadystatechange = function() {
        if (req.readyState == 4 && (req.status == 200 || req.status == 0)) {

            gallery.innerHTML = req.responseText;
        }

    };


    console.log('REQQQQ ===>', req);
})();