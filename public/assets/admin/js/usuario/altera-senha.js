'use strict'

document.querySelector('#frmAlterarSenha').addEventListener('click', e => {

    let pass = document.querySelector('#senha').value;
    let pass2 = document.querySelector('#comfirmaSenha').value;


    if (pass.length < 7) {
        e.preventDefault();
        document.querySelector('#dvAlert').innerHTML = '<div class="alert alert-warning">As senhas devem ter ao menos sete caracters.</div>';
    }

    if (pass !== pass2) {
        e.preventDefault();
        document.querySelector('#dvAlert').innerHTML = '<div class="alert alert-warning">As senhas não correspondem.</div>';
    }

});

console.log(el);