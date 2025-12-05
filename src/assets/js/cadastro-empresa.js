const cnpjInput = document.getElementById("tem-cnpj-sim");
const camposCnpj = document.getElementById("campos-cnpj");

    cnpjInput.addEventListener("input", () => {
        if (cnpjInput.value === "1") {
            camposCnpj.style.display = "flex"; // mostra
        } else {
            camposCnpj.style.display = "none";  // esconde
        }
    });
const cnpjInputNao = document.getElementById("tem-cnpj-nao");

    cnpjInputNao.addEventListener("input", () => {
        if (cnpjInputNao.value === "0") {
            camposCnpj.style.display = "none"; // mostra
        } else {
            camposCnpj.style.display = "flex";  // esconde
        }
    });
