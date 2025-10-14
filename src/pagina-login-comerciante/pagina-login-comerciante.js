const btnVerSenha = document.querySelector('#btnVerSenha');
const input_senha = document.querySelector('#senha')
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