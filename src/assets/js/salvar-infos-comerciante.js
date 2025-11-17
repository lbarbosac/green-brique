document.addEventListener('DOMContentLoaded', function() {
    const inputTelefone = document.getElementById('telefone');

    if(inputTelefone) {
        inputTelefone.addEventListener('input', function(e) {
            let valor = e.target.value;

            // 1. Remove tudo que não é número
            valor = valor.replace(/\D/g, "");

            // 2. Limita a 11 dígitos (DDD + 9 dígitos)
            valor = valor.substring(0, 11);

            // 3. Aplica a formatação
            // Coloca parênteses em volta dos dois primeiros dígitos
            valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2");
            
            // Coloca o hífen antes dos últimos 4 dígitos
            valor = valor.replace(/(\d)(\d{4})$/, "$1-$2");

            // 4. Atualiza o valor no input
            e.target.value = valor;
        });
    }
});