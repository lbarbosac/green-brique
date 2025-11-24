document.addEventListener('DOMContentLoaded', function() {
    
    // --- Formatação do Telefone (DDD) ---
    const phoneInput = document.getElementById('telefone');
    
    if (phoneInput) {
        phoneInput.addEventListener('input', handlePhoneInput);
    }

    // --- Mostrar/Esconder Senha ---
    setupPasswordToggle('senha', 'btnVerSenha');
    setupPasswordToggle('confirmar_senha', 'btnVerConfirmarSenha');

});

/**
 * Formata o valor do input de telefone enquanto o usuário digita.
 * Adiciona (XX) ao redor do DDD.
 */
function handlePhoneInput(e) {
    const input = e.target;
    // 1. Remove tudo que não é dígito
    let value = input.value.replace(/\D/g, '');
    let formattedValue = '';

    if (value.length > 0) {
        // 2. Adiciona o parêntese de abertura e os 2 primeiros dígitos
        formattedValue = '(' + value.substring(0, 2);
    }

    if (value.length > 2) {
        // 3. Adiciona o parêntese de fechamento e o restante do número
        // Limita o número a 11 dígitos no total (2 de DDD + 9 de número)
        formattedValue += ') ' + value.substring(2, 11); 
    }
    
    // 4. Atualiza o valor do input
    input.value = formattedValue;
}
