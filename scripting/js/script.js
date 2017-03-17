
var cadre = document.querySelector('.cadre');
var masques = document.querySelectorAll('.m');
console.log(masques);

var canvas = document.querySelector('.canvas');
var context = canvas.getContext('2d');

for (var i= 0; i < masques.length; i++) {
    masque = masques[i];
    var test = function (e) {
        if (this.getAttribute('style')) {
            alert('objet deja selectionne');
            e.preventDefault();
        }
        this.setAttribute('style', 'opacity: 0.5');
        console.log(this);
        e.stopPropagation();
        this.removeEventListener('click', test);
    }
    console.log(masque.addEventListener('click', test));
}

window.addEventListener('click', function () {
    for (var i= 0; i < masques.length; i++) {
        masque = masques[i];
        masque.removeAttribute('style');
        console.log(masque);
    }
})