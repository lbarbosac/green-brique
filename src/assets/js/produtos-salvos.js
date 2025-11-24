document.addEventListener('DOMContentLoaded', () => {
    const lista = document.getElementById('lista-salvos');
    const salvos = JSON.parse(localStorage.getItem('produtosSalvos') || "[]");
  
    if (salvos.length === 0) {
      lista.innerHTML = "<p>Você ainda não salvou nenhum produto.</p>";
      return;
    }
  
    salvos.forEach(produto => {
      // Cria um link para a página do produto
      const wrapper = document.createElement("a");
      wrapper.href = `./info-produto.php?id=${produto.id}`;
      wrapper.className = "produto-salvo";
      wrapper.setAttribute("tabindex", "0");
      wrapper.innerHTML = `
        <img src="${produto.img}" alt="Imagem do produto ${produto.nome}">
        <div class="produto-info">
          <span class="produto-titulo">${produto.nome}</span>
        </div>
      `;
      lista.appendChild(wrapper);
    });
  });
  