const btnVerSenha = document.querySelector('#btnVerSenha');
const input_senha = document.querySelector('#senha')
btnVerSenha.addEventListener('click', () => {
    if (input_senha.type === 'password') {
        input_senha.type = 'text';
        btnVerSenha.classList.add('fa-eye'); // Adicione uma classe para o olho aberto
        btnVerSenha.classList.remove('fa-eye-slash'); // Remova a classe do olho fechado
    } else {
        input_senha.type = 'password';
        btnVerSenha.classList.add('fa-eye-slash'); // Adicione uma classe para o olho fechado
        btnVerSenha.classList.remove('fa-eye'); // Remova a classe do olho aberto
    }
});