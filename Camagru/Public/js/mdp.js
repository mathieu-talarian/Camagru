/**
 * Created by mmoullec on 4/27/17.
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

    var btn = document.getElementById('maj-mdp');



    btn.addEventListener('click', function (e) {
        e.preventDefault();
        console.log('test');
        this.removeEventListener('click', arguments.callee, false);
    });
