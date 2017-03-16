console.log('salut');
var cadre = document.querySelector('.cadre');
var masques = document.querySelectorAll('.m');
console.log(masques);

var canvas = document.querySelector('.canvas');
var context = canvas.getContext('2d');

function transparency () {

}

for (var i= 0; i < masques.length; i++) {
    masques.removeEventListener('click', transparency());
    console.log('test');
    masque = masques[i];
    masque.addEventListener('click', transparency());
}
// masques.addEventListener('click', function () {
//    console.log(this);
// });