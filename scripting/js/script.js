
var cadre = document.querySelector('.cadre');
var masques = document.querySelectorAll('.m');

var selected = null;
var canvas = document.querySelector('.canvas');
var context = canvas.getContext('2d');

for (var i= 0; i < masques.length; i++) {
    masque = masques[i];
    var test = function (e) {
        if (!selected) {
            selected = this;
            selected.setAttribute('style', 'opacity: 0.5');
        }
        else {
            selected.removeAttribute('style');
            if (selected === this) {
                alert('Vous ne pouvez pas selectionner le meme objet!!!!!');
            }
            selected = this;
            selected.setAttribute('style', 'opacity: 0.5');
        }
        e.stopPropagation();
        context.drawImage('selected', 0, 0, 10, 10);
    }
    masque.addEventListener('click', test);
}

