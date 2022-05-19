'use strict'

document.querySelector('#frmNovo').addEventListener('submit', e => {

    if (!validate()) {
        e.preventDefault();
    }

})

function validate() {

    //Se for inválido:
    //return false;

    return true;
}