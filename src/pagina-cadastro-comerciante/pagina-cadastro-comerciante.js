const btnVerSenha = document.querySelector('#btnVerSenha');
const input_senha = document.querySelector('#senha');
btnVerSenha.addEventListener('click', () => {
    if (input_senha.type === 'password') {
        input_senha.type = 'text';
        btnVerSenha.classList.add('fa-eye'); 
        btnVerSenha.classList.remove('fa-eye-slash');
    } else {
        input_senha.type = 'password';
        btnVerSenha.classList.add('fa-eye-slash'); 
        btnVerSenha.classList.remove('fa-eye'); 
    }
});

const btnVerConfirmarSenha = document.querySelector('#btnVerConfirmarSenha');
const input_confirmar_senha = document.querySelector('#confirmar_senha');
btnVerConfirmarSenha.addEventListener('click', () => {
    if (input_confirmar_senha.type === 'password') {
        input_confirmar_senha.type = 'text';
        btnVerConfirmarSenha.classList.add('fa-eye'); 
        btnVerConfirmarSenha.classList.remove('fa-eye-slash');
    } else {
        input_confirmar_senha.type = 'password';
        btnVerConfirmarSenha.classList.add('fa-eye-slash'); 
        btnVerConfirmarSenha.classList.remove('fa-eye'); 
    }
});

