require('./bootstrap');

const crea_ristorante = document.getElementById('crea-ristorante');
const vat_totale = document.getElementById('vat-sbagliato');
const numero_totale = document.getElementById('numero-sbagliato');
const typologies_sbagliata = document.getElementById('typologies_sbagliata');

crea_ristorante.addEventListener('click', function(event){
    const vat = document.getElementById('vat').value;
    if(vat.length != 11){
        event.preventDefault();
        vat_totale.classList.add('no-number');
    }
    else vat_totale.classList.remove('no-number');
    //
    const number = document.getElementById('telephone').value;
    if(number.length != 10){
        event.preventDefault();
        numero_totale.classList.add('no-number');
    }
    else numero_totale.classList.remove('no-number');
});


crea_ristorante.addEventListener('click', function(event){
    if(check_checkbox()){
        typologies_sbagliata.classList.remove('no-number');
    }
    else {
        event.preventDefault();
        typologies_sbagliata.classList.add('no-number');
    }
});

function check_checkbox(){
    const check = document.querySelectorAll('input[type=checkbox]')
    for (var i = 0; i < check.length; i++){
        if (check[i].checked)
        {
            return true;
        }
    }
    return false;
}